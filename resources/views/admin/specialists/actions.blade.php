<div class="flex items-center gap-2">
    {{-- Botón de Editar --}}
    <x-wire-button href="{{ route('admin.specialists.edit', $specialist) }}" icon="pencil" blue xs />

    {{-- Formulario de Eliminación con la clase delete-form --}}
    <form action="{{ route('admin.specialists.destroy', $specialist) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <x-wire-button type="submit" icon="trash" red xs />
    </form>
</div>
