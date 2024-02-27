<template>
    <!-- {{ refCommunionDetails }} -->
    <form @submit.prevent="handleSubmit">
        <div class="row">
            <div class="col-md-9 mb-3">
                <label for="inputFile">Upload File</label><br>
                <input type="file" @input="handleInputFile" ref="refInputFile" name="file" class="form-control-file" id="inputFile" accept=".xls, .xlsx, .csv" required>
                <small class="text-danger">{{ systemStore.error.communion && systemStore.error.communion.file ? systemStore.error.communion.file[0] : '' }}</small>

            </div>

            <div class="col-md-3 mb-3" >
                <a href="/forms/first-communion-format.xlsx" class="btn btn-success btn-sm">Download Form</a> &nbsp;
                <button v-if="showSubmitButton" type="button" class="btn btn-primary btn-sm" ref="refSubmitButton" data-bs-toggle="modal" data-bs-target="#commununionDetailModal">Save</button>
                <!-- Modal -->
                <div v-if="refCommunionDetails.details" class="modal fade" id="commununionDetailModal" tabindex="-1" aria-labelledby="commununionDetailModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="commununionDetailModalLabel">Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" v-if="!successRegistration">
                        <p>Are you sure you want to submit the list for Communion Reservation?</p>
                        <p> Total number of people: <strong>{{ refCommunionDetails.details.length }}</strong></p>
                        <button type="submit" class="btn btn-primary btn-sm">Confirm Submit</button>
                    </div>

                    <div class="modal-body" v-if="successRegistration">
                        <div class="row">
                            <div class="col-md-12 d-flex flex-column align-items-center gap-2 my-5">
                                <i class="far fa-check-circle display-1 text-success"></i>
                                <strong>Communion Reservation submitted successfully</strong>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-md-12">
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
                        <td>{{ item.contact_number }}</td>
                        <td>{{ item.present_address }}</td>
                    </tr>
                    
                </tbody>
                </table>
            </div>
        </div>
    </form>
</template>

<script setup>
import { ref, onBeforeMount } from 'vue'
import XLSX from 'xlsx';
import { useSystemStore } from '../../../store/system';

const systemStore = useSystemStore()
const successRegistration = ref(false)
const refInputFile = ref()
const refSubmitButton = ref()
const showSubmitButton = ref(false)
const model = 'communion'

const refCommunionDetails = ref({
    file: null,
    details: null
})

const emits = defineEmits(['eventCreated'])

const handleSubmit = async () => {
    try {
        const formData = new FormData();
        formData.append('file', refCommunionDetails.value.file);
        formData.append('details', JSON.stringify(refCommunionDetails.value.details));

        const response = await window.axios.post('/api/events/communions', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        if(response) {
            console.log(response)
            systemStore.reset()
            refInputFile.value.disabled = true
            showSubmitButton.value = false
            successRegistration.value = true
        }

    } catch (error) {
        console.log(error)
        handleError(error)
    }
}

const resetValues = async () => {
    refCommunionDetails.value.file = null
    refCommunionDetails.value.details = null
}

const handleError = (error) => {
    if(error.response.data.message) {
        systemStore.systemStatus = error.response.data.message
    }

    console.error('Something went wrong: '. error)
    systemStore.error = { [model]: error.response.data.errors }

    return error
}

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
            header: ["name", "birth_date", "guardian", "contact_number", "present_address"],
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
        if(refCommunionDetails.value.details.length > 0) {
            showSubmitButton.value = true
        }
    };

    // Read the file as binary data
    reader.readAsBinaryString(e.target.files[0]);

}

const loadCommunionDetails = async () => {
    let url = window.location.href;
    let segments = url.split('/');
    let lastSegment = segments[segments.length - 1];

    // Check if the last segment is numeric
    if (!isNaN(lastSegment)) {
        // If numeric, treat it as an ID and fetch details
        await window.axios.get('/api/events/communions/' + lastSegment).then((response) => {
            // console.log(response);
            refCommunionDetails.value.details = response.data.details;
            refInputFile.value.disabled = true
            showSubmitButton.value = false
        });
    } else {
        // If not numeric, treat it as a 'create' action
        console.log('Create new Communion');
        // Add your logic for handling 'create' action here
    }
};

// const toggleModal = () => {
//   const modal = Modal(document.getElementById('commununionDetailModal'));
//   modal.toggle();
// };

onBeforeMount(() => {
    systemStore.reset()
    loadCommunionDetails()
})

</script>