<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AutoMall | Super Admin</title>
<style>
body{margin:0;font-family:Arial,sans-serif;background:#f4f4f5;color:#18181b}
header{background:#171717;color:white;padding:22px 6%;border-bottom:4px solid #dc2626}
main{max-width:1000px;margin:35px auto;padding:0 20px}
.panel{background:white;padding:24px;border-radius:12px;margin:18px 0;box-shadow:0 2px 10px #0000000b}
.tag{color:#dc2626;font-weight:bold}
a{color:#dc2626;text-decoration:none;margin-right:18px}
</style>
</head>
<body>
<header><h2>AutoMall <span class="tag">SUPER ADMIN</span></h2><div>Platform control centre</div></header>
<main>
<h1>Welcome, {{ auth()->user()->name }}</h1>
<p>You are signed in with Super Admin access.</p>
<div class="panel"><h3>Platform Management</h3><p>Manage users, assign roles, and oversee AutoMall operations.</p><p><strong>User and role management is the next feature to connect.</strong></p></div>
<div class="panel"><h3>Your Account</h3><p>{{ auth()->user()->email }}</p><p>Super Admin identity is protected by the application.</p></div>
<p><a href="{{ route('dashboard') }}">Dealer dashboard</a><a href="{{ route('home') }}">Home</a></p>
<form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Log out</button></form>
</main>
<a href="{{ route('admin.users') }}" style="display:inline-block;background:#e11d48;color:white;padding:12px 18px;border-radius:7px;text-decoration:none;margin:8px 0;">Manage Users</a>
</body>
</html>