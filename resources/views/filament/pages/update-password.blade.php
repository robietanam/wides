<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <div class="mt-4">
            <x-filament::button type="submit" color="primary">
                Update Password
            </x-filament::button>
        </div>
    </form>
</x-filament::page>
