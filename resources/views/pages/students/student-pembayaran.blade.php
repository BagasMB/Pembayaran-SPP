<x-applayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:student.studentpaymentpage :title="$title" :student_id="$student_id"  :class="$class" :thn1="$thn1" :thn2="$thn2" />
</x-applayout>
