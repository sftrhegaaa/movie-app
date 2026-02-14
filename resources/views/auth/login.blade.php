<!DOCTYPE html>
<head>
    <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4">🎬 Movie App Login</h3>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="/login">
                        {{ csrf_field() }}

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" 
                                   class="form-control" 
                                   placeholder="Enter username"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" 
                                   class="form-control" 
                                   placeholder="Enter password"
                                   required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </form>

                </div>
            </div>

           

        </div>
    </div>
</div>


</body>
</html>
