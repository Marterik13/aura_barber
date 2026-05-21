<div class="flex items-center gap-2">
    {{-- Botón de Editar --}}
    <x-wire-button href="{{ route('admin.services.edit', $service) }}" icon="pencil" blue xs />

    {{-- Formulario de Eliminación con la clase delete-form --}}
    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <x-wire-button type="submit" icon="trash" red xs />
    </form>
</div>
