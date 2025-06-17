<x-applayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:student.studentclasspage :title="$title" :tahun_masuk="$tahun_masuk" :class_id="$class_id" />
</x-applayout>
