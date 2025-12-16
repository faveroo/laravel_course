<form action="{{ route('register') }}" method="POST">
    @csrf

    <x-auth.input
        type="text"
        name="name"
        label="Full Name" />

    <x-auth.input
        type="email"
        name="email"
        label="Email Address" />

    <x-auth.input
        type="password"
        name="password"
        label="Password" />

    <x-auth.input
        type="password"
        name="password_confirmation"
        label="Confirm Password" />

    <button class="btn btn-primary w-100">
        Create account
    </button>
</form>