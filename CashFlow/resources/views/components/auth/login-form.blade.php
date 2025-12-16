<form action="{{ route('login') }}" method="POST">
    @csrf

    <x-auth.input
        type="email"
        name="email"
        label="Email Address" />

    <x-auth.input
        type="password"
        name="password"
        label="Password" />

    <div class="form-check mb-3">
        <input type="checkbox" name="remember" class="form-check-input">
        <label class="form-check-label">Remember me</label>
    </div>

    <button class="btn btn-primary w-100">
        Sign in
    </button>
</form>