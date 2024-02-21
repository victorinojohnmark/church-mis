<template>
    {{ refCommunionDetails }}
    <div class="row">
        <div class="col-md-11 mb-3">
            <label for="inputFile">Upload File</label><br>
            <input type="file" @input="handleInputFile" name="file" class="form-control-file" id="inputFile" accept=".xls, .xlsx, .csv" required>
        </div>

        <div class="col-md-1 mb-3" v-if="refCommunionDetails.details">
            <button type="button" class="btn btn-primary ml-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Save</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to submit the list for Communion Reservation?</p>
                    <p> Total number of people: <strong>{{ refCommunionDetails.details.length }}</strong></p>

                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="col-md-12">
            {{ refCommunionDetails.details }}

            <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col">Guardian</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Address</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in refCommunionDetails.details">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ item.name }}</td>
                    <td>{{ item.birth_date }}</td>
                    <td>{{ item.guardian }}</td>
                    <td>{{ item.contact_no }}</td>
                    <td>{{ item.address }}</td>
                </tr>
                
            </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import XLSX from 'xlsx';

const refCommunionDetails = ref({
    file: null,
    details: null
})

const dateParser = (value) => {
    const parts = value.split('/');
    let year = parseInt(parts[2]);

    // Logic to determine the correct year based on assumptions
    if (year < 100) {
        // Assuming a cutoff year, for example, 50 as the cutoff year
        year = year + 2000; // Assuming years less than 100 are in the 2000s
        // Alternatively, you can use some other logic to determine the year
    }

    const month = parts[0].padStart(2, '0');
    const day = parts[1].padStart(2, '0');
    return `${month}/${day}/${year}`;
};

const handleInputFile = (e) => {
    //handle file input assign value to the refCommunionDetails.value.file
    refCommunionDetails.value.file = e.target.files[0]

    // Create a FileReader object to read the file
    const reader = new FileReader();

    reader.onload = (event) => {
        // Get the binary data of the Excel file
        const data = event.target.result;

        // Convert binary data to workbook
        const workbook = XLSX.read(data, { type: 'binary' });

        // Get the first sheet
        const sheetName = workbook.SheetNames[0];
        const sheet = workbook.Sheets[sheetName];

        // Convert sheet data to JSON, starting from the 3rd row (index 2)
        const jsonData = XLSX.utils.sheet_to_json(sheet, {
            header: ["name", "birth_date", "guardian", "contact_no", "address"],
            range: 2,
            raw: false,
            defval: "",
            cellDates: false, // Do not parse dates automatically by XLSX
            cellText: false, // Preserve original cell text
            dateNF: 'yyyy-mm-dd', // Format of dates (if any) in the sheet
            columnDefs: [
                { type: 'date', targets: 1 }
            ],
            columnTypes: [
                { type: 'string' },
                { type: 'date', dateFormat: 'mm/dd/yyyy', parser: dateParser }, // Use custom date parser
                { type: 'string' },
                { type: 'string' },
                { type: 'string' }
            ]
        });

        // Assign JSON data to refCommunionDetails.value.details
        refCommunionDetails.value.details = jsonData;
    };

    // Read the file as binary data
    reader.readAsBinaryString(e.target.files[0]);

}

</script>