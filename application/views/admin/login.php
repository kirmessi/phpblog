<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login to the admin panel</div>
        <div class="card-body">
            <form action="/admin" method="post">
                <div class="form-group">
                    <label>Login</label>
                    <input class="form-control" type="text" name="login">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </form>
        </div>
    </div>
</div>