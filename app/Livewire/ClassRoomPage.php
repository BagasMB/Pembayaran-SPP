<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClassRoom;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;

class ClassRoomPage extends Component
{
    use WithPagination;

    public $search = '';
    public $paginate = 10;
    protected $paginationTheme = 'bootstrap';

    public function updateSearch()
    {
        $this->resetPage(); // Reset ke halaman 1 saat search berubah
    }

    public function loadData()
    {
        return ClassRoom::with('majors')->orderBy('name_class', 'ASC')->where(function ($query) {
            $query->where('name_class', 'like', '%' . $this->search . '%');
            // ->orWhere('jurusan', 'like', '%' . $this->search . '%');
        })->paginate($this->paginate);
    }

    public function destroy($id)
    {
        ClassRoom::findorfail($id)->delete();
        flash()->success('Data Berhasil Di Hapus 🎉');
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed($id)
    {
        $this->deleteClass($id);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('show-delete-confirmation', id: $id);
    }

    public function deleteClass($id)
    {
        try {
            $class = ClassRoom::withCount('students')->findOrFail($id);
            if ($class->students_count > 0) {
                flash()->success('Kelas tidak dapat dihapus karena sedang digunakan oleh data siswa. Silakan ubah data siswa terlebih dahulu.');
                // $class->reset();
                return;
            }
            $class->delete();
            $this->reset();
            flash()->success('Data Berhasil Di Hapus 🎉');
        } catch (\Exception $e) {
            // Log::error($e);
            Log::error($e->getMessage());
            flash()->success('Data Berhasil Di Haaaaapus 🎉');
            session()->flash('status', 'Terjadi kesalahan saat menghapus kelas.');
        }
    }

    public function render()
    {
        return view('livewire.class-room-page', ['classList' => $this->loadData()]);
    }
}
