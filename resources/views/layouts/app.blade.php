<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  @vite(['resources/sass/app.scss'])
  @vite(['resources/css/app.css'])
  @stack('css')
</head>
<body>
    <div id="app">
      @include('layouts.navbar')

      <main>
          @yield('content')
      </main>
    </div>
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

        const notificationBadge = document.querySelector('.notificationBadge');
        const notificationBadgeDocumentRequest = document.querySelector('.notificationBadgeDocumentRequest');
        
        if (notificationBadge) {
          // Fetch and update Event notification count
          updateNotificationBadge('/user/notifications/get-notification-count/event', '.notificationBadgeEvent');
        }

        if(notificationBadgeDocumentRequest) {
          // Fetch and update Document Request notification count
          updateNotificationBadge('/user/notifications/get-notification-count/document_request', '.notificationBadgeDocumentRequest');
        }
        
      </script>
</body>
</html>
