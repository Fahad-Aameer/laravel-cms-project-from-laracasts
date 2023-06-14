<x-layout>

    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Log In</h1>

            <form method="POST" action="/login" class="mt-10">
                @csrf

                <x-form.input name="email" type="email" autocomplete="username" />
                <x-form.input name="password" type="password" autocomplete="new-password" />

                <x-submit-button>Log In</x-submit-button>


            </form>

        </main>
    </section>
</x-layout>
