<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | AutoMall</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f5;
            color: #18181b;
        }
        header {
            background: #111;
            color: white;
            padding: 18px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        .brand { font-size: 23px; font-weight: bold; }
        .brand span { color: #e11d48; }
        a { color: inherit; }
        .top-link { text-decoration: none; margin-left: 16px; }
        main { max-width: 1150px; margin: 35px auto; padding: 0 18px; }
        h1 { margin-bottom: 8px; }
        .subtitle { color: #71717a; margin-top: 0; }
        .notice {
            padding: 13px 16px;
            border-radius: 8px;
            margin: 18px 0;
            background: #fff;
        }
        .success { border-left: 4px solid #16a34a; }
        .error { border-left: 4px solid #e11d48; }
        .table-wrap {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 3px 14px #0000000b;
        }
        table { width: 100%; border-collapse: collapse; min-width: 720px; }
        th, td {
            padding: 16px;
            border-bottom: 1px solid #e4e4e7;
            text-align: left;
        }
        th { background: #18181b; color: white; font-size: 13px; }
        select, button {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #d4d4d8;
        }
        button {
            background: #e11d48;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin-left: 5px;
        }
        button:hover { background: #be123c; }
        .protected { color: #e11d48; font-weight: bold; }
        .role { text-transform: capitalize; }
        .pagination { margin-top: 20px; }
        .pagination nav > div { display: flex; gap: 12px; flex-wrap: wrap; }
        footer { text-align: center; color: #71717a; padding: 30px; }
    </style>
</head>
<body>
<header>
    <div class="brand">Auto<span>Mall</span></div>
    <nav>
        <a class="top-link" href="{{ route('admin.super') }}">Super Admin</a>
        <a class="top-link" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="top-link" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
            @csrf
        </form>
    </nav>
</header>

<main>
    <h1>Manage Users</h1>
    <p class="subtitle">View registered accounts and assign their AutoMall access roles.</p>

    @if (session('success'))
        <div class="notice success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="notice error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="notice error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Current Role</th>
                    <th>Change Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="role">
                            {{ $user->isSuperAdmin() ? 'Super Admin' : $user->role }}
                        </td>
                        <td>
                            @if ($user->isSuperAdmin())
                                <span class="protected">Protected account</span>
                            @else
                                <form action="{{ route('admin.users.role', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" required>
                                        <option value="dealer" @selected($user->role === 'dealer')>Dealer</option>
                                        <option value="staff" @selected($user->role === 'staff')>Staff</option>
                                        <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                    </select>
                                    <button type="submit">Save</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No registered users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $users->links() }}
    </div>
</main>

<footer>AutoMall B2B Marketplace &copy; {{ date('Y') }}</footer>
</body>
</html>