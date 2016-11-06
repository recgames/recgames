<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title') · recgam.es</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="nojs">
  {{-- UI State --}}
  <input id="s-menu-open" type="checkbox" class="is-hidden" name="{{ uniqid() }}">

  <nav class="nav has-shadow">
    <div class="container">
      <div class="nav-left">
        <a href="{{ url('/') }}" class="nav-item is-brand">
          recgam.es
        </a>
      </div>

      <label class="nav-toggle" for="s-menu-open">
        <span></span>
        <span></span>
        <span></span>
      </label>

      <div class="nav-right nav-menu">
        <a class="nav-item" href="{{ url('/') }}">Games</a>
        <span class="nav-item">
          <a class="button is-primary" href="{{ action('GamesController@upload') }}">
            <span>Upload</span>
          </a>
        </span>
      </ul>
    </div>
  </nav>

  @yield('content')

  <script>
    function $ (sel, ctx) {
      return [].slice.call((ctx || document).querySelectorAll(sel))
    }
    function deselectTabs (tablist) {
      $('[role="tab"]', tablist).forEach(function (tabHref) {
        var tab = tabHref.parentNode
        var target = tabHref.getAttribute('href')
        if (tab.classList.contains('is-active')) {
          tab.classList.remove('is-active')
          target && $(target).forEach(function (panel) {
            panel.classList.remove('is-active')
          })
        }
      })
    }
    function selectTab (tabHref) {
      var tab = tabHref.parentNode
      var target = tabHref.getAttribute('href')
      tab.classList.add('is-active')
      target && $(target).forEach(function (panel) {
        panel.classList.add('is-active')
      })
    }

    $('.tabs').forEach(function (tablist) {
      tablist.addEventListener('click', function (event) {
        deselectTabs(tablist)
        selectTab(event.target)
      }, false)
    })

    document.body.classList.remove('nojs')
    document.body.classList.add('js')
  </script>
</body>
</html>
