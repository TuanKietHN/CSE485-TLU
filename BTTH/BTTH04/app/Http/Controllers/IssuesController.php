<?php
namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Issue;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    public function index()
    {
        // Lấy tất cả các vấn đề cùng với thông tin máy tính
        $issues = Issue::with('computer')->paginate(5);

        return view('issues.index', compact('issues'));
    }

    public function create()
    {
        $computers = Computer::all();
        return view('issues.create', compact('computers'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        // Tạo vấn đề mới
        Issue::create([
            'computer_id' => $request->computer_id,
            'reported_by' => $request->reported_by,
            'reported_date' => $request->reported_date,
            'description' => $request->description,
            'urgency' => $request->urgency,
            'status' => $request->status,
        ]);

        return redirect()->route('issues.index')->with('success', 'Báo cáo vấn đề đã được gửi thành công.');
    }

    public function edit($id)
    {
        $issue = Issue::findOrFail($id);
        $computers = Computer::all();
        return view('issues.edit', compact('issue', 'computers'));
    }

    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        // Tìm vấn đề và cập nhật
        $issue = Issue::findOrFail($id);
        $issue->update([
            'computer_id' => $request->computer_id,
            'reported_by' => $request->reported_by,
            'reported_date' => $request->reported_date,
            'description' => $request->description,
            'urgency' => $request->urgency,
            'status' => $request->status,
        ]);

        return redirect()->route('issues.index')->with('success', 'Thông tin vấn đề đã được cập nhật.');
    }

    public function destroy($id)
    {
        // Tìm và xóa vấn đề
        $issue = Issue::findOrFail($id);
        $issue->delete();

        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được xóa thành công.');
    }
}
