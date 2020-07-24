<form method="POST">
    @csrf

    @foreach($form->fields as $field)
        {{ optional($field)->render() }}
    @endforeach
</form>
