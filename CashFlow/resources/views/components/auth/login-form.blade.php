<form action="{{ route('login') }}" method="POST" class="flex flex-col h-full justify-center">
    @csrf

    <h1 class="font-bold text-3xl mb-6 text-center text-white">Sign In</h1>
    <div class="space-y-4 mb-4">
        <!-- Social Icons (Optional placeholders if you want them, otherwise clean) -->
        <div class="flex justify-center gap-4 mb-4">
            <a href="#" class="border border-dark-border rounded-full p-2 text-text-secondary hover:text-white hover:bg-dark-surface transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"></path>
                </svg>
            </a>
            <!-- Add more if needed -->
        </div>
        <p class="text-xs text-center text-text-secondary">or use your email password</p>
    </div>

    <input type="hidden" name="form_type" value="login">

    <x-auth.input
        form="login"
        type="email"
        name="email"
        label="Email Address" />

    <x-auth.input
        form="login"
        type="password"
        name="password"
        label="Password" />

    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-dark-border bg-dark-bg text-primary focus:ring-primary focus:ring-offset-dark-surface">
            <label for="remember" class="ml-2 text-sm text-text-secondary">Remember me</label>
        </div>
        <a href="#" class="text-sm font-medium text-primary hover:text-primary-hover">Forgot Password?</a>
    </div>

    <button class="w-full py-3 px-4 bg-primary hover:bg-primary-hover text-white rounded-lg transition-colors font-medium shadow-lg hover:shadow-primary/50">
        Sign in
    </button>
</form>