<?php

namespace App\Admin\Controllers;

use App\EmergencyContact;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class EmergencyContactsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Emergency Contact')
            ->description('Description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('Description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('Description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('Add New Emergency Contact')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmergencyContact);
        $grid->setTitle("Emergency Contact");

        //$grid->id('ID');
        $grid->name('Name')->editable();
        $grid->contact('Contact No')->editable();
        $grid->photo('Photo')->image();
        $states = [
                'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => 'No', 'color' => 'danger'],
            ];
        $grid->active('Active')->switch($states);
        //$grid->created_at('Created At');
        $grid->updated_at('Last Updated');
        //$grid->orderable();

        //$grid->disableActions();
        $grid->disableRowSelector();
        //$grid->disableExport();
        $grid->disableFilter();
        $grid->disablePagination();
        //$grid->disableCreateButton();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(EmergencyContact::findOrFail($id));

        $show->id('ID');
        $show->name('Name');
        $show->contact('Contact No');
        $show->photo('Photo')->image();
        $states = [
            'on' => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
        ];
        $show->active('Active')->as(function ($s) {
            return $s ? 'Yes' : 'No';
        });
        $show->created_at('Created At');
        $show->updated_at('Updated At');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EmergencyContact);

        $form->text('name', 'Name')->rules('required');
        $form->text('contact', 'Contact No')->rules('required');
        $form->image('photo', 'Photo')
            ->help("Photo size must be same in <b>Height</b> and <b>Width</b>. i.e 100 x 100 or 500 x 500 or S x S.")
            ->value('images/defaultAdmin.png')
            ->uniqueName();
        $states = [
            'on' => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
        ];
        $form->switch('active', 'Active')->states($states);

        // $form->saving(function ($form) {

        //     $success = new MessageBag([
        //         'title'   => 'New Emergency Contact',
        //         'message' => 'Congrats! Emergency contact info added successfully.',
        //     ]);
        
        //     return back()->with(compact('success'));
        // });
        return $form;
    }
}
