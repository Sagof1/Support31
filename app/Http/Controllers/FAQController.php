<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQBlock;
use App\Models\FAQSection;
use Illuminate\Support\Facades\Auth;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = FAQBlock::all();
        return view('faq.index', compact('blocks'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($blockId)
    {
        $block = FAQBlock::findOrFail($blockId);
        $sections = $block->sections;

        return view('support.show', compact('block', 'sections'));
    }

    public function create()
    {
        return view('support.create');
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $block = FAQBlock::create($request->only('title', 'description'));

        return redirect()->route('faq.show', $block->id)->with('success', 'FAQ block created successfully.');
    }

    public function edit($blockId)
    {


        $block = FAQBlock::findOrFail($blockId);

        return view('support.edit', compact('block'));
    }

    public function update(Request $request, $blockId)
    {


        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $block = FAQBlock::findOrFail($blockId);
        $block->update($request->only('title', 'description'));

        return redirect()->route('faq.show', $block->id)->with('success', 'FAQ block updated successfully.');
    }

    public function destroy($blockId)
    {

        $block = FAQBlock::findOrFail($blockId);
        $block->delete();

        return redirect()->route('home')->with('success', 'FAQ block deleted successfully.');
    }

    //public function newsection

    public function addSection(Request $request, $blockId)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $block = FAQBlock::findOrFail($blockId);

        $section = new FAQSection([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        $block->sections()->save($section);

        return redirect()->route('faq.edit', $block->id)->with('success', 'FAQ section added successfully.');
    }

    public function updateSection(Request $request, $blockId, $sectionId)
    {

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $block = FAQBlock::findOrFail($blockId);
        $section = $block->sections()->findOrFail($sectionId);

        $section->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return view('support.section', compact('block', 'section'));
    }

    public function deleteSection($blockId, $sectionId)
    {

        $block = FAQBlock::findOrFail($blockId);
        $section = $block->sections()->findOrFail($sectionId);

        $section->delete();

        return redirect()->route('faq.edit', $block->id)->with('success', 'FAQ section deleted successfully.');
    }

    public function section($blockId, $sectionId)
    {
        $block = FAQBlock::findOrFail($blockId);
        $section = FAQSection::findOrFail($sectionId);

        return view('support.section', compact('block', 'section'));
    }
    public function createSection(FAQBlock $block)
    {
        return view('support.create_section', compact('block'));
    }
    public function editSection($blockId, $sectionId)
    {
        $block = FAQBlock::findOrFail($blockId);
        $section = FAQSection::findOrFail($sectionId);

        return view('support.section_edit', compact('block', 'section'));
    }
}
