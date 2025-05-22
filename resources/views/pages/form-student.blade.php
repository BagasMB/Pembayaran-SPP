<x-AppLayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:form.formstudent :title="$title" :studentID="$studentID" />
</x-AppLayout>
