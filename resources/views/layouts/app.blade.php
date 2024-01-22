<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  @vite(['resources/sass/app.scss'])
  @vite(['resources/css/app.css'])
  @stack('css')
</head>
<body>
    @include('layouts.navbar')

    <main>
        @yield('content')
    </main>
    {{-- <footer class="bg-dark py-4 mt-auto w-full">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">Copyright © St. Gregory the Great Parish</div>
                </div>
                <div class="col-auto">
                    <a class="link-light small" href="#!">Privacy</a>
                    <span class="text-white mx-1">·</span>
                    <a class="link-light small" href="#!">Contact</a>
                </div>
            </div>
        </div>
    </footer> --}}
    @vite(['resources/js/app.js'])
    @vite(['resources/js/custom.js'])
    @stack('scripts')
    <script>
        // Function to fetch notification count and update the badge
        async function updateNotificationBadge(apiUrl, badgeSelector) {
          try {
            const response = await fetch(apiUrl);
            const data = await response.json();
      
            // Update the badge value with the fetched count
            const badgeElement = document.querySelector(badgeSelector);
            if (badgeElement) {
              badgeElement.textContent = data.count;
            }
          } catch (error) {
            console.error('Error fetching notification count:', error);
          }
        }
      
        // Fetch and update Event notification count
        updateNotificationBadge('/user/notifications/get-notification-count/event', '.notificationBadgeEvent');
      
        // Fetch and update Document Request notification count
        updateNotificationBadge('/user/notifications/get-notification-count/document_request', '.notificationBadgeDocumentRequest');
      </script>
</body>
</html>
