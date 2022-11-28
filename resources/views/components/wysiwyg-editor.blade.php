<textarea {!! $attributes->merge(['id' => 'editor']) !!}>
    {{ $slot }}
</textarea>
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush