<?php

namespace App\Admin\Controllers;

use App\Notice;
use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use DB;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Facades\Admin;
//use App\Admin\Extensions\Form\CKEditor;


class NoticeController extends Controller
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
            ->header('Notice')
            ->description('List')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('')
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
            ->description('')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Notice);

        $id = $grid->id('ID')->sortable();
        $grid->title('Title')->display(function($text) {
            return str_limit($text, 50, '...');
        })->sortable();
        $grid->body('Body')->display(function($text) {
            return str_limit($text, 50, '...');
        });
        $grid->cover_image('Cover Image')->display(function ($s) {
            return "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='/storage/" . $s . "' alt='" . $this->name . "'/>";
        });
        $grid->noticeregistration('Registration No')->sortable();
        $grid->user_id('Created By')->display(function ($s) {
            return Administrator::all()->find($s)->name;
        })->badge('primary')->sortable();
        $grid->created_at('Created At')->sortable();
        $grid->updated_at('Updated At')->sortable();


        // Disabled Buttons

        //$grid->orderable();
        //$grid->disableCreateButton();

        $grid->actions(function ($actions) {

            // Disabled Actions
            //$actions->disableEdit();
            //$actions->disableDelete();
            //$actions->disableView();

            //Active Actions

            // append an action.
            //$actions->append('<a href=""><i class="fa fa-eye"></i></a>');

            // prepend an action.
            //$actions->prepend('<a href="/admin/auth/notices/'.$actions->getKey().'/edit"><i class="fa fa-edit"></i></a>'); //"/admin/auth/notices/'.$this->id.'/edit"
        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Notice::findOrFail($id));
        $show->panel()->title('Post Details');

        $show->id('ID');
        $show->title('Title');
        $show->body('Notice Text');
        $show->cover_image('Cover Image')->as(function ($s) {
            return "<img style='max-width:200px;max-height:200px' class='img img-thumbnail' src='/storage/" . $s . "' alt='" . $this->name . "'/>";
        });
        $show->noticeregistration('Notice Registration Number');
        $show->user_id('Created By')->as(function ($s) {
            return Administrator::all()->find($s)->name;
        });
        $show->created_at('Created At');
        $show->updated_at('Updated At');

        // edit button have to change

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Notice);
        //$form->ckeditor('content');
        $form->text('title', 'Title')
            ->rules('required');
        $form->ckeditor('body', 'Body')
            ->placeholder('Input Notice Message')
            ->rules('required');
        $form->image('cover_image', 'Cover Image')
            ->move('/cover_images/')
            ->uniqueName()
            ->value('cover_images/noimage.jpeg');
        $form->text('noticeregistration', 'Notice Registration No')
            ->rules('required');
        //$form->number('user_id', 'User id');
        $form->hidden('user_id', 'Created By')->default(function () {
            return Admin::user()->id;
        });

        return $form;
    }
}
