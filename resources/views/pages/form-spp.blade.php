<x-AppLayout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:form.FormSpp :title="$title" :sppID="$sppID"/>
</x-AppLayout>
