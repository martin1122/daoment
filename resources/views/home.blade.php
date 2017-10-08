
<!DOCTYPE html>
<html>
<head>
  <title>Coin Index</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" />
  <meta name="robots" content="noindex,nofollow" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="/css/app.css" />
</head>
<body>
  <div id="app">
    <div class="jumbotron">
      <div class="container">
        <h1>Daoment</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <ul class="nav nav-tabs nav-justified">
          <index v-for="index in indices" :key="index.id" :index="index"></index>
        </ul>
      </div>
    </div>
    <div class="container">
      <div class="tab-content">
        <graph v-for="index in indices" :key="index.id" :index="index"></graph>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="/js/app.js"></script>
</body>
</html>