<x-AppLayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:form.formmajor :title="$title" :majorID="$majorID" />
</x-AppLayout>
