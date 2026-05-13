<x-layout>
    <div class="flex min-h-screen items-center justify-center">
        <form method="POST" action="/login" class="mx-auto w-fit mt-10">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
                <legend class="fieldset-legend">Login</legend>

                <label class="label">Email</label>
                <input type="email" name="email" class="input" placeholder="Email" required />

                <label class="label">Password</label>
                <input type="password" name="password" class="input" placeholder="Password" required />

                <button class="btn btn-neutral mt-4">Login</button>
            </fieldset>
        </form>
    </div>
</x-layout>