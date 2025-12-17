<form action="{{ route('register') }}" method="POST">
    @csrf

    <input type="hidden" name="form_type" value="register">

    <x-auth.input
        form="register"
        type="text"
        name="name"
        label="Full Name" />

    <x-auth.input
        form="register"
        type="email"
        name="email"
        label="Email Address" />

    <x-auth.input
        form="register"
        type="password"
        name="password"
        label="Password" />

    <x-auth.input
        form="register"
        type="password"
        name="password_confirmation"
        label="Confirm Password" />


    <button class="btn btn-primary w-100">
        Create account
    </button>
</form>