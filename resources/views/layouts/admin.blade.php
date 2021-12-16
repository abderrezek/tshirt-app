<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/admin/admin.css') }}" rel="stylesheet" />
  </head>
  <body>
    <div class="spinner" id="spinner">
      <div class="lds-dual-ring"></div>
    </div>
    @inertia

    <script type="text/javascript">
      window.addEventListener('load', (event) => {
        var ele = document.getElementById('spinner');
        ele.parentNode.removeChild(ele);

        document.body.style.overflow = 'visible';
      });
    </script>
    @routes
    <script src="{{ mix('/js/admin/admin.js') }}" defer></script>
  </body>
</html>