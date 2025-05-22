<x-AppLayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Content -->
    <livewire:Form.EditUser :userID="$id" />
    <!-- / Content -->
</x-AppLayout>
