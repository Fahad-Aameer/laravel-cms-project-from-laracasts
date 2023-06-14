<x-layout>

    <x-setting heading="Publish New Post">
        <form action="/admin/posts" method="POST" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" />
            <x-form.input name="slug" />
            <x-form.input name="thumbnail" type="file" />
            <x-form.textarea name="excerpt">{{ old('excerpt') }}</x-form.textarea>
            <x-form.textarea name="body">{{ old('body') }}</x-form.textarea>

            <div class="mb-6">
                <x-form.label name="category" />

                <select name="category_id" id="category_id">
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ ucwords($category->name) }}
                        </option>
                    @endforeach
                </select>
                <x-form.error name="category" />
            </div>

            <x-submit-button>Publish</x-submit-button>
        </form>
    </x-setting>
</x-layout>
