<x-AppLayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:form.FormTeacher :title="$title" :teacherID="$TeacherID" />
</x-AppLayout>
