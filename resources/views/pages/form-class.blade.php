<x-AppLayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:form.FormClass :title="$title" :classID="$classID"/>
</x-AppLayout>
