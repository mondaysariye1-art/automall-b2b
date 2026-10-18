<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AutoMall | Staff</title>
<style>
body{margin:0;font-family:Arial,sans-serif;background:#f4f4f5;color:#18181b}
header{background:#171717;color:white;padding:22px 6%;border-bottom:4px solid #dc2626}
main{max-width:1000px;margin:35px auto;padding:0 20px}
.panel{background:white;padding:24px;border-radius:12px;margin:18px 0}
a{color:#dc2626;text-decoration:none}
</style>
</head>
<body>
<header><h2>AutoMall | Staff</h2><div>Staff workspace</div></header>
<main><h1>Welcome, {{ auth()->user()->name }}</h1>
<div class="panel"><h3>Your Workspace</h3><p>Your assigned staff tools will appear here.</p></div>
<p><a href="{{ route('home') }}">Home</a></p>
<form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Log out</button></form>
</main>
</body>
</html>