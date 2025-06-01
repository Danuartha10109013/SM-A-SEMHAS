<?php

namespace App\Http\Controllers;

use App\Models\DivisionM;
use App\Models\KapasitasM;
use App\Models\KondisiM;
use App\Models\ShftM;
use App\Models\TeamLeadM;
use App\Models\TrailerNameM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DataMasterController extends Controller
{
    public function index(){

        return view('master-data.index');
    }
    public function formCheck(){
        
        return view('master-data.index');
    }

    public function store(Request $request)
    {
        $data = ShftM::create([
            'shift' => $request->shift,
            'description' => $request->description,
        ]);

        return response()->json($data);
    }

    public function update(Request $request, $id)
{
    try {
        $shift = ShftM::findOrFail($id);

        $field = $request->input('field');
        $value = $request->input('value');

        // Opsional: Validasi field yang diizinkan
        if (!in_array($field, ['shift', 'description'])) {
            return response()->json(['error' => 'Invalid field'], 400);
        }

        $shift->{$field} = $value;
        $shift->save();

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        Log::error('Update Shift Error: ' . $e->getMessage());
        return response()->json(['error' => 'Gagal update'], 500);
    }
}


public function destroy($id)
{
    try {
        $deleted = ShftM::destroy($id);
        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    } catch (\Exception $e) {
        Log::error('Delete Shift Error: ' . $e->getMessage());
        return response()->json(['error' => 'Gagal menghapus data'], 500);
    }
}

public function storetl(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'nullable|string', // comma-separated
        'active' => 'required|boolean',
        'user_id' => 'required|exists:users,id',
    ]);

    $teamLead = TeamLeadM::create([
        'name' => $request->name,
        'type' => $request->type ?? '',
        'active' => $request->active,
        'user_id' => $request->user_id,
    ]);

    return response()->json(['success' => true, 'id' => $teamLead->id]);
}

    // Update a single field of a TeamLead by id
  public function updatetl(Request $request, $id)
{
    $teamLead = TeamLeadM::find($id);

    if (!$teamLead) {
        return response()->json(['success' => false, 'message' => 'Data not found'], 404);
    }

    $field = $request->field;
    $value = $request->value;

    // validate field names and assign
    switch ($field) {
        case 'name':
            $teamLead->name = $value;
            break;
        case 'type':
            $teamLead->type = $value;
            break;
        case 'active':
            $teamLead->active = (int)$value;
            break;
        case 'user_id':
            $teamLead->user_id = (int)$value;
            // optional: also update name based on user
            $user = User::find($value);
            if ($user) {
                $teamLead->name = $user->name;
            }
            break;
        default:
            return response()->json(['success' => false, 'message' => 'Invalid field'], 422);
    }

    $teamLead->save();

    return response()->json(['success' => true]);
}


    // Delete a TeamLead by id
    public function destroytl($id)
{
    $teamLead = TeamLeadM::find($id);

    if (!$teamLead) {
        return response()->json(['success' => false, 'message' => 'Not found'], 404);
    }

    $teamLead->delete();

    return response()->json(['success' => true]);
}

public function indexfc(){
    return view('master-data.fc.index');
}

public function storekap(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'jenis' => 'required|string',
        ]);

        $kapasitas = new KapasitasM();
        $kapasitas->name = $request->name;
        $kapasitas->jenis = $request->jenis;
        $kapasitas->save();

        return response()->json(['message' => 'Kapasitas ditambahkan']);
    }

    public function updatekap(Request $request, $id)
    {
        $request->validate([
            'field' => 'required|string',
            'value' => 'required|string',
        ]);

        $kapasitas = KapasitasM::findOrFail($id);
        $kapasitas->{$request->field} = $request->value;
        $kapasitas->save();

        return response()->json(['message' => 'Kapasitas diupdate']);
    }

    public function deletekap($id)
    {
        $kapasitas = KapasitasM::findOrFail($id);
        $kapasitas->delete();

        return response()->json(['message' => 'Kapasitas dihapus']);
    }

    public function updatetr(Request $request, $id)
    {
        $trailer = TrailerNameM::findOrFail($id);
        $field = $request->input('field');
        $value = $request->input('value');

        if (!in_array($field, ['no_mobil', 'pengguna'])) {
            return response()->json(['error' => 'Field tidak valid.'], 400);
        }

        $trailer->$field = $value;
        $trailer->save();

        return response()->json(['success' => true]);
    }

    public function storetr(Request $request)
    {
        $trailer = TrailerNameM::create([
            'no_mobil' => $request->input('no_mobil', 'Baru'),
            'pengguna' => $request->input('pengguna', 'Baru'),
        ]);

        return response()->json(['id' => $trailer->id]);
    }

    public function destroytr($id)
    {
        $trailer = TrailerNameM::findOrFail($id);
        $trailer->delete();

        return response()->json(['success' => true]);
    }

    public function indexko(){
        return view('master-data.kondisi.index');
    }

    public function storeko(Request $request)
{
    $request->validate([
        'kondisi' => 'required|string|max:255',
        'type' => 'nullable|array', // expect array from frontend
        'type.*' => 'string',       // each type item is string
    ]);

    $data = KondisiM::create([
        'kondisi' => $request->kondisi,
        'type' => json_encode($request->type ?? []), // save as JSON string
    ]);

    return response()->json([
        'id' => $data->id,
        'message' => 'Data berhasil ditambahkan'
    ]);
}


public function updateko(Request $request, $id)
{
    $item = KondisiM::findOrFail($id);

    // Validate incoming data
    $request->validate([
        'kondisi' => 'sometimes|required|string|max:255',
        'type' => 'sometimes|array',
        'type.*' => 'string',
    ]);

    if ($request->has('kondisi')) {
        $item->kondisi = $request->kondisi;
    }

    if ($request->has('type')) {
        $item->type = json_encode($request->type);
    }

    $item->save();

    return response()->json(['message' => 'Updated successfully']);
}


public function destroyko($id)
{
    $item = KondisiM::findOrFail($id);
    $item->delete();

    return response()->json(['message' => 'Deleted successfully']);
}

public function indexdi(){
    $data = DivisionM::all();
    return view('master-data.division.index',compact('data'));
}

// Store
public function storedi(Request $request)
{
    $data = $request->only('division', 'keterangan', 'type');

    // Convert type array to JSON
    $data['type'] = json_encode($data['type'] ?? []);

    $division = DivisionM::create($data);

    return response()->json([
        'success' => true,
        'message' => 'Data berhasil ditambahkan',
        'id' => $division->id,
    ]);
}

// Update
public function updatedi(Request $request, $id)
{
    $division = DivisionM::findOrFail($id);

    $data = $request->only('division', 'keterangan', 'type');
    $data['type'] = json_encode($data['type'] ?? []);

    $division->update($data);

    return response()->json([
        'success' => true,
        'message' => 'Data berhasil diperbarui',
    ]);
}

// Delete (no change needed)
public function destroydi($id)
{
    $division = DivisionM::findOrFail($id);
    $division->delete();

    return response()->json([
        'success' => true,
        'message' => 'Data berhasil dihapus',
    ]);
}





}
