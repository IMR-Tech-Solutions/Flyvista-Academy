<?php

namespace App\Controllers;

use App\Models\FlyvistaModel;

class FlyvistaAdminController extends BaseController
{
    public function __adminconstruct()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('admin/signin'))->send();
        }
    }

    // Show login page
    public function signIn()
    {
        return view('backend/signin');
    }

    protected $usertable = 'user';

    // Handle login form
    public function handleSignIn()
    {
        $session = session();
        $request = $this->request;

        $email = trim($request->getPost('email'));
        $password = trim($request->getPost('password'));

        if (empty($email) || empty($password)) {
            return redirect()->to(base_url('signin'))->with('error', 'Email and password are required');
        }

        $model = new FlyvistaModel();

        // Fetch user
        $user = $model->getTableData('user', ['email' => $email]);
        $user = $user[0] ?? null; // still object here

        if ($user) {

            // FIX: use object-style access
            if ((int)$user->status !== 1) {
                return redirect()->to(base_url('signin'))->with('error', 'Your account is inactive.');
            }

            if (password_verify($password, $user->password)) {

                // FIX: object-style access
                session()->set([
                    'user_id'    => $user->id,
                    'user_name'  => $user->first_name . ' ' . $user->last_name,
                    'user_email' => $user->email,
                    'profile_photo'  => $user->profile_photo,
                    'isLoggedIn' => true,
                ]);

                return redirect()->to(base_url('admin'));
            }

            return redirect()->to(base_url('signin'))->with('error', 'Invalid password');
        }

        return redirect()->to(base_url('signin'))->with('error', 'User not found');
    }

    // Admin dashboard
    public function Admin_Dashboard()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('signin'));
        }

        return
            view('backend/templates/header') .
            view('backend/admin-dashboard') .
            view('backend/templates/footer');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('signin'));
    }


    protected $model;

    public function __construct()
    {
        $this->model = new FlyvistaModel();
    }

    // Users List
    public function User()
    {
        $data['users'] = $this->model->getTableData('user');
        return view('backend/templates/header')
            . view('backend/user', $data)
            . view('backend/templates/footer');
    }

    // Add User Form
    public function addUser()
    {
        return view('backend/templates/header')
            . view('backend/add-user')
            . view('backend/templates/footer');
    }

    // Save User
    public function saveUser()
    {
        $file = $this->request->getFile('profile_photo'); // FIXED
        $imageName = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move('assets/img/users/', $imageName);
        }

        $data = [
            'first_name'    => $this->request->getPost('first_name'),
            'last_name'     => $this->request->getPost('last_name'),
            'email'         => $this->request->getPost('email'),
            'phone'         => $this->request->getPost('phone'),
            'status'        => $this->request->getPost('status'),
            'profile_photo' => $imageName,
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ];

        $inserted = $this->model->insertData('user', $data);

        return $inserted
            ? redirect()->to(base_url('admin/user'))->with('success', 'User added successfully.')
            : redirect()->to(base_url('admin/user'))->with('error', 'Failed to add user.');
    }

    // Edit User Form
    public function editUser($id)
    {
        $data['user'] = $this->model->getRowById('user', $id);

        return view('backend/templates/header')
            . view('backend/edit-user', $data)
            . view('backend/templates/footer');
    }

    // Update User
    public function updateUser($id)
    {
        $oldData = $this->model->getRowById('user', $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/user'))->with('error', 'Record not found.');
        }

        $file = $this->request->getFile('profile_photo'); // FIXED
        $imageName = $oldData['profile_photo']; // default old image

        if ($file && $file->isValid() && !$file->hasMoved()) {

            // Delete old image
            if (!empty($oldData['profile_photo'])) {
                $oldImagePath = FCPATH . 'assets/img/users/' . $oldData['profile_photo'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save new image
            $imageName = $file->getRandomName();
            $file->move('assets/img/users/', $imageName);
        }

        $data = [
            'first_name'    => $this->request->getPost('first_name'),
            'last_name'     => $this->request->getPost('last_name'),
            'email'         => $this->request->getPost('email'),
            'phone'         => $this->request->getPost('phone'),
            'status'        => $this->request->getPost('status'),
            'profile_photo' => $imageName,
        ];

        $updated = $this->model->updateRowById('user', $id, $data);

        return $updated
            ? redirect()->to(base_url('admin/user'))->with('success', 'User updated successfully.')
            : redirect()->to(base_url('admin/user'))->with('error', 'Update failed.');
    }

    // Delete User
    public function deleteUser($id)
    {
        $record = $this->model->getRowById('user', $id);

        if ($record) {

            if (!empty($record['profile_photo'])) {
                $imagePath = FCPATH . 'assets/img/users/' . $record['profile_photo'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $deleted = $this->model->deleteRowById('user', $id);

            return $deleted
                ? redirect()->to(base_url('admin/user'))->with('success', 'User deleted successfully.')
                : redirect()->to(base_url('admin/user'))->with('error', 'Delete failed.');
        }

        return redirect()->to(base_url('admin/user'))->with('error', 'Record not found.');
    }

    // Change Password Form
    public function changePassword($id)
    {
        $data['user'] = $this->model->getRowById('user', $id);

        return
            view('backend/templates/header') .
            view('backend/change-password', $data) .
            view('backend/templates/footer');
    }

    // Update Password
    public function updatePassword($id)
    {
        $user = $this->model->getRowById('user', $id);

        if (!$user) {
            return redirect()->to(base_url('admin/user'))->with('error', 'User not found.');
        }

        $currentPassword = $this->request->getPost('current_password');
        $newPassword     = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $redirectUrl = base_url('admin/user/change-password/' . $id);

        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->to($redirectUrl)->with('error', 'Current password is incorrect.');
        }

        if (strlen($newPassword) < 8) {
            return redirect()->to($redirectUrl)->with('error', 'New password must be at least 8 characters.');
        }

        if (!preg_match('/[0-9]/', $newPassword) || !preg_match('/[\W]/', $newPassword)) {
            return redirect()->to($redirectUrl)->with('error', 'Password must contain at least one number and one special character.');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->to($redirectUrl)->with('error', 'Password confirmation does not match.');
        }

        $updated = $this->model->updateRowById('user', $id, [
            'password' => password_hash($newPassword, PASSWORD_BCRYPT)
        ]);

        if ($updated) {
            return redirect()->to(base_url('admin/user'))->with('success', 'Password updated successfully.');
        } else {
            return redirect()->to($redirectUrl)->with('error', 'Password update failed.');
        }
    }


    // Hero Section Management
    protected $table = 'hero_section';

    // Show Hero Section List
    public function hero()
    {
        $model = new FlyvistaModel();
        $data['heros'] = $model->getTableData($this->table);

        return
            view('backend/templates/header') .
            view('backend/hero', $data) .
            view('backend/templates/footer');
    }

    // Add Hero Page
    public function addHero()
    {
        return
            view('backend/templates/header') .
            view('backend/add-hero') .
            view('backend/templates/footer');
    }

    // Save Hero
    public function saveHero()
    {
        $model = new FlyvistaModel();

        // Upload Images
        $fields = ['bg_shape_image', 'left_image', 'right_image'];
        $uploadPath = 'assets/img/home/';

        $uploadedImages = [];

        foreach ($fields as $field) {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move($uploadPath, $imageName);
                $uploadedImages[$field] = $imageName;
            } else {
                $uploadedImages[$field] = '';
            }
        }

        $data = [
            'tagline'          => $this->request->getPost('tagline'),
            'title'            => $this->request->getPost('title'),
            'description'      => $this->request->getPost('description'),
            'button_link'      => $this->request->getPost('button_link'),
            'contact_number'   => $this->request->getPost('contact_number'),
            'experience_years' => $this->request->getPost('experience_years'),
            'experience_text'  => $this->request->getPost('experience_text'),
            'bg_shape_image'   => $uploadedImages['bg_shape_image'],
            'left_image'       => $uploadedImages['left_image'],
            'right_image'      => $uploadedImages['right_image'],
        ];

        $model->insertData($this->table, $data);

        return redirect()->to(base_url('admin/hero'))->with('success', 'Hero Section Added Successfully.');
    }

    // Edit Page
    public function editHero($id)
    {
        $model = new FlyvistaModel();
        $data['hero'] = $model->getRowById($this->table, $id);

        if (!$data['hero']) {
            return redirect()->to(base_url('admin/hero'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-hero', $data) .
            view('backend/templates/footer');
    }

    // Update Hero
    public function updateHero($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->table, $id);

        if (!$oldData) {
            return redirect()->to('admin/hero')->with('error', 'Record not found.');
        }

        $fields = ['bg_shape_image', 'left_image', 'right_image'];
        $uploadPath = 'assets/img/home/';

        $uploadedImages = [];

        foreach ($fields as $field) {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && !$file->hasMoved()) {
                // delete old
                $oldPath = $uploadPath . $oldData[$field];
                if (!empty($oldData[$field]) && file_exists($oldPath)) {
                    unlink($oldPath);
                }

                // save new
                $imageName = $file->getRandomName();
                $file->move($uploadPath, $imageName);
                $uploadedImages[$field] = $imageName;
            } else {
                $uploadedImages[$field] = $oldData[$field];
            }
        }

        $data = [
            'tagline'          => $this->request->getPost('tagline'),
            'title'            => $this->request->getPost('title'),
            'description'      => $this->request->getPost('description'),
            'button_link'      => $this->request->getPost('button_link'),
            'contact_number'   => $this->request->getPost('contact_number'),
            'experience_years' => $this->request->getPost('experience_years'),
            'experience_text'  => $this->request->getPost('experience_text'),
            'bg_shape_image'   => $uploadedImages['bg_shape_image'],
            'left_image'       => $uploadedImages['left_image'],
            'right_image'      => $uploadedImages['right_image'],
        ];

        $model->updateRowById($this->table, $id, $data);

        return redirect()->to(base_url('admin/hero'))->with('success', 'Hero Section Updated Successfully.');
    }

    // Delete Hero
    public function deleteHero($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->table, $id);
        $uploadPath = 'assets/img/home/';

        if ($record) {
            foreach (['bg_shape_image', 'left_image', 'right_image'] as $imgField) {
                if (!empty($record[$imgField])) {
                    $path = $uploadPath . $record[$imgField];
                    if (file_exists($path)) unlink($path);
                }
            }

            $model->deleteRowById($this->table, $id);

            return redirect()->to(base_url('admin/hero'))->with('success', 'Hero Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/hero'))->with('error', 'Delete failed.');
    }


    // ABOUT SECTION MANAGEMENT
    protected $aboutTable = 'about_section';

    // List About Section
    public function about()
    {
        $model = new FlyvistaModel();
        $data['about'] = $model->getTableData($this->aboutTable);

        return
            view('backend/templates/header') .
            view('backend/about', $data) .
            view('backend/templates/footer');
    }

    // Add About Page
    public function addAbout()
    {
        return
            view('backend/templates/header') .
            view('backend/add-about') .
            view('backend/templates/footer');
    }

    // Save About Section
    public function saveAbout()
    {
        $model = new FlyvistaModel();
        $uploadPath = 'assets/img/about/';

        $fields = ['image1', 'image2', 'instructor_image'];
        $uploadedImages = [];

        foreach ($fields as $field) {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                $uploadedImages[$field] = $newName;
            } else {
                $uploadedImages[$field] = '';
            }
        }

        $data = [
            'image1'               => $uploadedImages['image1'],
            'image2'               => $uploadedImages['image2'],
            'progress_percent'     => $this->request->getPost('progress_percent'),
            'tag_text'             => $this->request->getPost('tag_text'),
            'heading'              => $this->request->getPost('heading'),
            'description'          => $this->request->getPost('description'),
            'feature1_icon'        => $this->request->getPost('feature1_icon'),
            'feature1_title'       => $this->request->getPost('feature1_title'),
            'feature1_description' => $this->request->getPost('feature1_description'),
            'learn_more_link'      => $this->request->getPost('learn_more_link'),
            'instructor_image'     => $uploadedImages['instructor_image'],
            'instructor_title'     => $this->request->getPost('instructor_title'),
            'instructor_name'      => $this->request->getPost('instructor_name'),
        ];

        $model->insertData($this->aboutTable, $data);

        return redirect()->to(base_url('admin/about'))->with('success', 'About Section Added Successfully.');
    }

    // Edit About Page
    public function editAbout($id)
    {
        $model = new FlyvistaModel();
        $data['about'] = $model->getRowById($this->aboutTable, $id);

        if (!$data['about']) {
            return redirect()->to(base_url('admin/about'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-about', $data) .
            view('backend/templates/footer');
    }

    // Update About Section
    public function updateAbout($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->aboutTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/about'))->with('error', 'Record not found.');
        }

        $fields = ['image1', 'image2', 'instructor_image'];
        $uploadPath = 'assets/img/about/';
        $uploadedImages = [];

        foreach ($fields as $field) {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && !$file->hasMoved()) {

                // Delete old file
                if (!empty($oldData[$field])) {
                    $oldPath = $uploadPath . $oldData[$field];
                    if (file_exists($oldPath)) unlink($oldPath);
                }

                // Save new image
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                $uploadedImages[$field] = $newName;
            } else {
                $uploadedImages[$field] = $oldData[$field];
            }
        }

        $data = [
            'image1'               => $uploadedImages['image1'],
            'image2'               => $uploadedImages['image2'],
            'progress_percent'     => $this->request->getPost('progress_percent'),
            'tag_text'             => $this->request->getPost('tag_text'),
            'heading'              => $this->request->getPost('heading'),
            'description'          => $this->request->getPost('description'),
            'feature1_icon'        => $this->request->getPost('feature1_icon'),
            'feature1_title'       => $this->request->getPost('feature1_title'),
            'feature1_description' => $this->request->getPost('feature1_description'),
            'learn_more_link'      => $this->request->getPost('learn_more_link'),
            'instructor_image'     => $uploadedImages['instructor_image'],
            'instructor_title'     => $this->request->getPost('instructor_title'),
            'instructor_name'      => $this->request->getPost('instructor_name'),
        ];

        $model->updateRowById($this->aboutTable, $id, $data);

        return redirect()->to(base_url('admin/about'))->with('success', 'About Section Updated Successfully.');
    }

    // Delete
    public function deleteAbout($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->aboutTable, $id);
        $uploadPath = 'assets/img/about/';

        if ($record) {
            foreach (['image1', 'image2', 'instructor_image'] as $field) {
                if (!empty($record[$field])) {
                    $path = $uploadPath . $record[$field];
                    if (file_exists($path)) unlink($path);
                }
            }

            $model->deleteRowById($this->aboutTable, $id);

            return redirect()->to(base_url('admin/about'))->with('success', 'About Section Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/about'))->with('error', 'Delete failed.');
    }

    // COURSES SECTION MANAGEMENT
    protected $courseTable = 'courses';

    // List Courses
    public function courses()
    {
        $model = new FlyvistaModel();
        $data['courses'] = $model->getTableData($this->courseTable);

        return
            view('backend/templates/header') .
            view('backend/courses', $data) .
            view('backend/templates/footer');
    }

    // Add Course Page
    public function addCourse()
    {
        return
            view('backend/templates/header') .
            view('backend/add-course') .
            view('backend/templates/footer');
    }

    // Save Course
    public function saveCourse()
    {
        $model = new FlyvistaModel();
        $uploadPath = 'assets/img/courses/';
        $file = $this->request->getFile('image');
        $imageName = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move($uploadPath, $imageName);
        }

        $data = [
            'subheading'        => $this->request->getPost('subheading'),
            'heading'           => $this->request->getPost('heading'),
            'title'             => $this->request->getPost('title'),
            'slug'              => $this->request->getPost('slug'),
            'category'          => $this->request->getPost('category'),
            'image'             => $imageName,
            'icon'              => $this->request->getPost('icon'),
            'short_description' => $this->request->getPost('short_description'),

            // NEW FIELDS
            'duration'          => $this->request->getPost('duration'),
            'level'             => $this->request->getPost('level'),
            'progress'          => $this->request->getPost('progress'),

            'status'            => $this->request->getPost('status'),
        ];

        $model->insertData($this->courseTable, $data);

        return redirect()->to(base_url('admin/courses'))->with('success', 'Course Added Successfully.');
    }

    // Edit Course Page
    public function editCourse($id)
    {
        $model = new FlyvistaModel();
        $data['course'] = $model->getRowById($this->courseTable, $id);

        if (!$data['course']) {
            return redirect()->to(base_url('admin/courses'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-course', $data) .
            view('backend/templates/footer');
    }

    // Update Course
    public function updateCourse($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->courseTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/courses'))->with('error', 'Record not found.');
        }

        $uploadPath = 'assets/img/courses/';
        $file = $this->request->getFile('image');
        $imageName = $oldData['image'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old image
            if (!empty($oldData['image'])) {
                $oldPath = $uploadPath . $oldData['image'];
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $imageName = $file->getRandomName();
            $file->move($uploadPath, $imageName);
        }

        $data = [
            'subheading'        => $this->request->getPost('subheading'),
            'heading'           => $this->request->getPost('heading'),
            'title'             => $this->request->getPost('title'),
            'slug'              => $this->request->getPost('slug'),
            'category'          => $this->request->getPost('category'),
            'image'             => $imageName,
            'icon'              => $this->request->getPost('icon'),
            'short_description' => $this->request->getPost('short_description'),

            // NEW FIELDS
            'duration'          => $this->request->getPost('duration'),
            'level'             => $this->request->getPost('level'),
            'progress'          => $this->request->getPost('progress'),

            'status'            => $this->request->getPost('status'),
        ];

        $model->updateRowById($this->courseTable, $id, $data);

        return redirect()->to(base_url('admin/courses'))->with('success', 'Course Updated Successfully.');
    }

    // Delete Course
    public function deleteCourse($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->courseTable, $id);
        $uploadPath = 'assets/img/courses/';

        if ($record) {
            if (!empty($record['image'])) {
                $path = $uploadPath . $record['image'];
                if (file_exists($path)) unlink($path);
            }

            $model->deleteRowById($this->courseTable, $id);

            return redirect()->to(base_url('admin/courses'))->with('success', 'Course Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/courses'))->with('error', 'Delete failed.');
    }

    // ADMISSION PROCESS SECTION MANAGEMENT
    protected $admissionTable = 'admission_process';

    // List Admission Process Steps
    public function admissionProcess()
    {
        $model = new FlyvistaModel();
        $data['admission_process'] = $model->getTableData($this->admissionTable);

        return
            view('backend/templates/header') .
            view('backend/admission-process', $data) .
            view('backend/templates/footer');
    }

    // Add Admission Step Page
    public function addAdmissionStep()
    {
        return
            view('backend/templates/header') .
            view('backend/add-admission-step') .
            view('backend/templates/footer');
    }

    // Save Admission Step
    public function saveAdmissionStep()
    {
        $model = new FlyvistaModel();

        $data = [
            'subheading'  => $this->request->getPost('subheading'),
            'heading'     => $this->request->getPost('heading'),
            'step_number' => $this->request->getPost('step_number'),
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('desc'),
            'icon'        => $this->request->getPost('icon'),
            'status'      => $this->request->getPost('status'),
        ];

        $model->insertData($this->admissionTable, $data);

        return redirect()->to(base_url('admin/admission'))->with('success', 'Admission Step Added Successfully.');
    }

    // Edit Admission Step Page
    public function editAdmissionStep($id)
    {
        $model = new FlyvistaModel();
        $data['admission'] = $model->getRowById($this->admissionTable, $id);

        if (!$data['admission']) {
            return redirect()->to(base_url('admin/admission'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-admission-step', $data) .
            view('backend/templates/footer');
    }

    // Update Admission Step
    public function updateAdmissionStep($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->admissionTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/admission'))->with('error', 'Record not found.');
        }

        $data = [
            'subheading'  => $this->request->getPost('subheading'),
            'heading'     => $this->request->getPost('heading'),
            'step_number' => $this->request->getPost('step_number'),
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('desc'),
            'icon'        => $this->request->getPost('icon'),
            'status'      => $this->request->getPost('status'),
        ];

        $model->updateRowById($this->admissionTable, $id, $data);

        return redirect()->to(base_url('admin/admission'))->with('success', 'Admission Step Updated Successfully.');
    }

    // Delete Admission Step
    public function deleteAdmissionStep($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->admissionTable, $id);

        if ($record) {
            $model->deleteRowById($this->admissionTable, $id);
            return redirect()->to(base_url('admin/admission'))->with('success', 'Admission Step Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/admission'))->with('error', 'Delete failed.');
    }

    // TESTIMONIALS SECTION MANAGEMENT
    protected $testimonialTable = 'testimonials';

    // List Testimonials
    public function testimonials()
    {
        $model = new FlyvistaModel();
        $data['testimonials'] = $model->getTableData($this->testimonialTable);

        return
            view('backend/templates/header') .
            view('backend/testimonials', $data) .
            view('backend/templates/footer');
    }

    // Add Testimonial Page
    public function addTestimonial()
    {
        return
            view('backend/templates/header') .
            view('backend/add-testimonial') .
            view('backend/templates/footer');
    }

    // Save Testimonial
    public function saveTestimonial()
    {
        $model = new FlyvistaModel();
        $uploadPath = 'assets/img/testimonials/';
        $file = $this->request->getFile('image');
        $imageName = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move($uploadPath, $imageName);
        }

        $data = [
            'heading'     => $this->request->getPost('heading'),
            'name'        => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'image'       => $imageName,
            'feedback'    => $this->request->getPost('feedback')
        ];

        $model->insertData($this->testimonialTable, $data);

        return redirect()->to(base_url('admin/testimonials'))->with('success', 'Testimonial Added Successfully.');
    }

    // Edit Testimonial Page
    public function editTestimonial($id)
    {
        $model = new FlyvistaModel();
        $data['testimonial'] = $model->getRowById($this->testimonialTable, $id);

        if (!$data['testimonial']) {
            return redirect()->to(base_url('admin/testimonials'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-testimonial', $data) .
            view('backend/templates/footer');
    }

    // Update Testimonial
    public function updateTestimonial($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->testimonialTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/testimonials'))->with('error', 'Record not found.');
        }

        $uploadPath = 'assets/img/testimonials/';
        $file = $this->request->getFile('image');
        $imageName = $oldData['image'];

        if ($file && $file->isValid() && !$file->hasMoved()) {

            // Delete old image
            if (!empty($oldData['image'])) {
                $oldPath = $uploadPath . $oldData['image'];
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $imageName = $file->getRandomName();
            $file->move($uploadPath, $imageName);
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'designation' => $this->request->getPost('designation'),
            'heading'     => $this->request->getPost('heading'),
            'image'       => $imageName,
            'feedback'    => $this->request->getPost('feedback')
        ];

        $model->updateRowById($this->testimonialTable, $id, $data);

        return redirect()->to(base_url('admin/testimonials'))->with('success', 'Testimonial Updated Successfully.');
    }

    // Delete Testimonial
    public function deleteTestimonial($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->testimonialTable, $id);
        $uploadPath = 'assets/img/home/';

        if ($record) {
            if (!empty($record['image'])) {
                $path = $uploadPath . $record['image'];
                if (file_exists($path)) unlink($path);
            }

            $model->deleteRowById($this->testimonialTable, $id);

            return redirect()->to(base_url('admin/testimonials'))->with('success', 'Testimonial Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/testimonials'))->with('error', 'Delete failed.');
    }

    // CONTACT INFO SECTION
    protected $contactTable = 'contact_info';

    // List Contact Info
    public function contactInfo()
    {
        $model = new FlyvistaModel();
        $data['contact'] = $model->getTableData($this->contactTable);

        return
            view('backend/templates/header') .
            view('backend/contact-info', $data) .
            view('backend/templates/footer');
    }

    // Add Contact Info Page
    public function addContactInfo()
    {
        return
            view('backend/templates/header') .
            view('backend/add-contact-info') .
            view('backend/templates/footer');
    }

    // Save Contact Info
    public function saveContactInfo()
    {
        $model = new FlyvistaModel();

        $data = [
            'location'       => $this->request->getPost('location'),
            'phone'          => $this->request->getPost('phone'),
            'email'          => $this->request->getPost('email'),
            'instagram'      => $this->request->getPost('instagram'),
            'linkedin'       => $this->request->getPost('linkedin'),
            'twitter'        => $this->request->getPost('twitter'),
            'whatsapp'       => $this->request->getPost('whatsapp'),
            'facebook'       => $this->request->getPost('facebook'),
            'opening_hours'  => $this->request->getPost('opening_hours')
        ];

        $model->insertData($this->contactTable, $data);

        return redirect()->to(base_url('admin/contact-info'))
            ->with('success', 'Contact Info Added Successfully.');
    }

    // Edit Contact Info Page
    public function editContactInfo($id)
    {
        $model = new FlyvistaModel();
        $data['contact'] = $model->getRowById($this->contactTable, $id);

        if (!$data['contact']) {
            return redirect()->to(base_url('admin/contact-info'))
                ->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-contact-info', $data) .
            view('backend/templates/footer');
    }

    // Update Contact Info
    public function updateContactInfo($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->contactTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/contact-info'))
                ->with('error', 'Record not found.');
        }

        $data = [
            'location'       => $this->request->getPost('location'),
            'phone'          => $this->request->getPost('phone'),
            'email'          => $this->request->getPost('email'),
            'instagram'      => $this->request->getPost('instagram'),
            'linkedin'       => $this->request->getPost('linkedin'),
            'twitter'        => $this->request->getPost('twitter'),
            'whatsapp'       => $this->request->getPost('whatsapp'),
            'facebook'       => $this->request->getPost('facebook'),
            'opening_hours'  => $this->request->getPost('opening_hours')
        ];

        $model->updateRowById($this->contactTable, $id, $data);

        return redirect()->to(base_url('admin/contact-info'))
            ->with('success', 'Contact Info Updated Successfully.');
    }

    // Delete Contact Info
    public function deleteContactInfo($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->contactTable, $id);

        if ($record) {
            $model->deleteRowById($this->contactTable, $id);

            return redirect()->to(base_url('admin/contact-info'))
                ->with('success', 'Contact Info Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/contact-info'))
            ->with('error', 'Delete failed.');
    }

    // Show Contact Form
    protected $contactFormtTable = 'contact_form';
    // SHOW CONTACT FORM SUBMISSIONS
    public function contactForm()
    {
        $model = new FlyvistaModel();

        // Get all submitted form entries (no limit)
        $data['contact_forms'] = $model->getTableData('contact_form', [], 'id', 0);

        return view('backend/templates/header')
            . view('backend/contact-form', $data)
            . view('backend/templates/footer');
    }

    // ----------------------------------------------
    // BLOG SECTION MANAGEMENT
    // ----------------------------------------------
    protected $blogTable = 'blog_posts';

    // List Blog Posts
    public function blogs()
    {
        $model = new FlyvistaModel();
        $data['blogs'] = $model->getTableData($this->blogTable);

        return
            view('backend/templates/header') .
            view('backend/blogs', $data) .
            view('backend/templates/footer');
    }

    // Add Blog Page
    public function addBlog()
    {
        return
            view('backend/templates/header') .
            view('backend/add-blog') .
            view('backend/templates/footer');
    }

    // Save Blog
    public function saveBlog()
    {
        $model = new FlyvistaModel();
        $uploadPath = 'assets/img/blog/';

        // Upload Image
        $file = $this->request->getFile('image');
        $imageName = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move($uploadPath, $imageName);
        }

        $data = [
            'title'        => $this->request->getPost('title'),
            'slug'         => strtolower(url_title($this->request->getPost('title'))),
            'category'     => $this->request->getPost('category'),
            'excerpt'      => $this->request->getPost('excerpt'),
            'content'      => $this->request->getPost('content'),
            'reading_time' => $this->request->getPost('reading_time'),
            'post_date'    => $this->request->getPost('post_date'),
            'status'       => $this->request->getPost('status'),
            'image'        => $imageName,
        ];

        $model->insertData($this->blogTable, $data);

        return redirect()->to(base_url('admin/blogs'))->with('success', 'Blog Added Successfully.');
    }

    // Edit Blog Page
    public function editBlog($id)
    {
        $model = new FlyvistaModel();
        $data['blog'] = $model->getRowById($this->blogTable, $id);

        if (!$data['blog']) {
            return redirect()->to(base_url('admin/blogs'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-blog', $data) .
            view('backend/templates/footer');
    }

    // Update Blog
    public function updateBlog($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->blogTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/blogs'))->with('error', 'Record not found.');
        }

        $uploadPath = 'assets/img/blog/';
        $file = $this->request->getFile('image');
        $imageName = $oldData['image'];

        // Upload New Image + Delete Old One
        if ($file && $file->isValid() && !$file->hasMoved()) {

            if (!empty($oldData['image'])) {
                $oldPath = $uploadPath . $oldData['image'];
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $imageName = $file->getRandomName();
            $file->move($uploadPath, $imageName);
        }

        $data = [
            'title'        => $this->request->getPost('title'),
            'slug'         => strtolower(url_title($this->request->getPost('title'))),
            'category'     => $this->request->getPost('category'),
            'excerpt'      => $this->request->getPost('excerpt'),
            'content'      => $this->request->getPost('content'),
            'reading_time' => $this->request->getPost('reading_time'),
            'post_date'    => $this->request->getPost('post_date'),
            'status'       => $this->request->getPost('status'),
            'image'        => $imageName
        ];

        $model->updateRowById($this->blogTable, $id, $data);

        return redirect()->to(base_url('admin/blogs'))->with('success', 'Blog Updated Successfully.');
    }

    // Delete Blog
    public function deleteBlog($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->blogTable, $id);
        $uploadPath = 'assets/img/blog/';

        if ($record) {

            if (!empty($record['image'])) {
                $path = $uploadPath . $record['image'];
                if (file_exists($path)) unlink($path);
            }

            $model->deleteRowById($this->blogTable, $id);

            return redirect()->to(base_url('admin/blogs'))->with('success', 'Blog Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/blogs'))->with('error', 'Delete failed.');
    }

    // =============================
    // MISSION & VISION SECTION
    // =============================

    protected $missionVisionTable = 'missions_vision';

    // List Records
    public function missionVision()
    {
        $model = new FlyvistaModel();
        $data['missionvision'] = $model->getTableData($this->missionVisionTable);

        return
            view('backend/templates/header') .
            view('backend/mission-vision', $data) .
            view('backend/templates/footer');
    }

    // Add Page
    public function addMissionVision()
    {
        return
            view('backend/templates/header') .
            view('backend/add-mission-vision') .
            view('backend/templates/footer');
    }

    // Save Record
    public function saveMissionVision()
    {
        $model = new FlyvistaModel();

        $uploadPath = 'assets/img/mission-vision/';
        $topImage = '';
        $bottomImage = '';

        // Upload Top Image
        $fileTop = $this->request->getFile('top_image');
        if ($fileTop && $fileTop->isValid() && !$fileTop->hasMoved()) {
            $topImage = $fileTop->getRandomName();
            $fileTop->move($uploadPath, $topImage);
        }

        // Upload Bottom Image
        $fileBottom = $this->request->getFile('bottom_image');
        if ($fileBottom && $fileBottom->isValid() && !$fileBottom->hasMoved()) {
            $bottomImage = $fileBottom->getRandomName();
            $fileBottom->move($uploadPath, $bottomImage);
        }

        $data = [
            'heading'               => $this->request->getPost('heading'),  // ⭐ ADDED

            'mission_title'         => $this->request->getPost('mission_title'),
            'mission_description'   => $this->request->getPost('mission_description'),

            'vision_title'          => $this->request->getPost('vision_title'),
            'vision_description'    => $this->request->getPost('vision_description'),

            'core_values_title'     => $this->request->getPost('core_values_title'),
            'core_values_description' => $this->request->getPost('core_values_description'),

            'top_image'             => $topImage,
            'bottom_image'          => $bottomImage,

            'badge_title'           => $this->request->getPost('badge_title'),
            'badge_count'           => $this->request->getPost('badge_count'),
        ];

        $model->insertData($this->missionVisionTable, $data);

        return redirect()->to(base_url('admin/mission-vision'))
            ->with('success', 'Mission & Vision Added Successfully.');
    }

    // Edit Page
    public function editMissionVision($id)
    {
        $model = new FlyvistaModel();
        $data['mv'] = $model->getRowById($this->missionVisionTable, $id);

        if (!$data['mv']) {
            return redirect()->to(base_url('admin/mission-vision'))
                ->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-mission-vision', $data) .
            view('backend/templates/footer');
    }

    // Update Record
    public function updateMissionVision($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->missionVisionTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/mission-vision'))->with('error', 'Record not found.');
        }

        $uploadPath = 'assets/img/mission-vision/';

        $topImage = $oldData['top_image'];
        $bottomImage = $oldData['bottom_image'];

        // Update Top Image
        $fileTop = $this->request->getFile('top_image');
        if ($fileTop && $fileTop->isValid() && !$fileTop->hasMoved()) {

            if (!empty($topImage)) {
                $oldPath = $uploadPath . $topImage;
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $topImage = $fileTop->getRandomName();
            $fileTop->move($uploadPath, $topImage);
        }

        // Update Bottom Image
        $fileBottom = $this->request->getFile('bottom_image');
        if ($fileBottom && $fileBottom->isValid() && !$fileBottom->hasMoved()) {

            if (!empty($bottomImage)) {
                $oldPath = $uploadPath . $bottomImage;
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $bottomImage = $fileBottom->getRandomName();
            $fileBottom->move($uploadPath, $bottomImage);
        }

        $data = [
            'heading'               => $this->request->getPost('heading'), // ⭐ NEW FIELD ADDED

            'mission_title'         => $this->request->getPost('mission_title'),
            'mission_description'   => $this->request->getPost('mission_description'),

            'vision_title'          => $this->request->getPost('vision_title'),
            'vision_description'    => $this->request->getPost('vision_description'),

            'core_values_title'     => $this->request->getPost('core_values_title'),
            'core_values_description' => $this->request->getPost('core_values_description'),

            'top_image'             => $topImage,
            'bottom_image'          => $bottomImage,

            'badge_title'           => $this->request->getPost('badge_title'),
            'badge_count'           => $this->request->getPost('badge_count'),
        ];

        $model->updateRowById($this->missionVisionTable, $id, $data);

        return redirect()->to(base_url('admin/mission-vision'))
            ->with('success', 'Mission & Vision Updated Successfully.');
    }

    // Delete Record
    public function deleteMissionVision($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->missionVisionTable, $id);

        $uploadPath = 'assets/img/mission-vision/';

        if ($record) {

            if (!empty($record['top_image'])) {
                $path = $uploadPath . $record['top_image'];
                if (file_exists($path)) unlink($path);
            }
            if (!empty($record['bottom_image'])) {
                $path = $uploadPath . $record['bottom_image'];
                if (file_exists($path)) unlink($path);
            }

            $model->deleteRowById($this->missionVisionTable, $id);

            return redirect()->to(base_url('admin/mission-vision'))->with('success', 'Record Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/mission-vision'))->with('error', 'Delete failed.');
    }

    protected $whyChooseTable = 'why_choose_us';

    // List all Why Choose Us cards
    public function whyChoose()
    {
        $model = new FlyvistaModel();
        $data['cards'] = $model->getTableData($this->whyChooseTable);

        return
            view('backend/templates/header') .
            view('backend/why-choose', $data) .
            view('backend/templates/footer');
    }

    // Add Card Page
    public function addWhyChoose()
    {
        return
            view('backend/templates/header') .
            view('backend/add-why-choose') .
            view('backend/templates/footer');
    }

    // Save Card
    public function saveWhyChoose()
    {
        $model = new FlyvistaModel();

        $data = [
            'heading'    => $this->request->getPost('heading'),
            'icon'       => $this->request->getPost('icon'),
            'title'      => $this->request->getPost('title'),
            'short_desc' => $this->request->getPost('short_desc'),
        ];

        $model->insertData($this->whyChooseTable, $data);

        return redirect()->to(base_url('admin/why-choose'))
            ->with('success', 'Card Added Successfully.');
    }

    // Edit Card Page
    public function editWhyChoose($id)
    {
        $model = new FlyvistaModel();
        $data['card'] = $model->getRowById($this->whyChooseTable, $id);

        if (!$data['card']) {
            return redirect()->to(base_url('admin/why-choose'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-why-choose', $data) .
            view('backend/templates/footer');
    }

    // Update Card
    public function updateWhyChoose($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->whyChooseTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/why-choose'))->with('error', 'Record not found.');
        }

        $data = [
            'heading'    => $this->request->getPost('heading'),
            'icon'       => $this->request->getPost('icon'),
            'title'      => $this->request->getPost('title'),
            'short_desc' => $this->request->getPost('short_desc'),
        ];

        $model->updateRowById($this->whyChooseTable, $id, $data);

        return redirect()->to(base_url('admin/why-choose'))
            ->with('success', 'Card Updated Successfully.');
    }

    // Delete Card
    public function deleteWhyChoose($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->whyChooseTable, $id);

        if ($record) {
            $model->deleteRowById($this->whyChooseTable, $id);
            return redirect()->to(base_url('admin/why-choose'))->with('success', 'Card Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/why-choose'))->with('error', 'Delete failed.');
    }

    // ----------------------------------------------
    // COUNTER SECTION MANAGEMENT
    // ----------------------------------------------
    protected $counterTable = 'counters';

    // List Counters
    public function counters()
    {
        $model = new FlyvistaModel();
        $data['counters'] = $model->getTableData($this->counterTable);

        return
            view('backend/templates/header') .
            view('backend/counters', $data) .
            view('backend/templates/footer');
    }

    // Add Counter Page
    public function addCounter()
    {
        return
            view('backend/templates/header') .
            view('backend/add-counter') .
            view('backend/templates/footer');
    }

    // Save Counter
    public function saveCounter()
    {
        $model = new FlyvistaModel();

        $data = [
            'icon'  => $this->request->getPost('icon'),
            'count' => $this->request->getPost('count'),
            'title' => $this->request->getPost('title'),
        ];

        $model->insertData($this->counterTable, $data);

        return redirect()->to(base_url('admin/counters'))->with('success', 'Counter Added Successfully.');
    }

    // Edit Counter Page
    public function editCounter($id)
    {
        $model = new FlyvistaModel();
        $data['counter'] = $model->getRowById($this->counterTable, $id);

        if (!$data['counter']) {
            return redirect()->to(base_url('admin/counters'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-counter', $data) .
            view('backend/templates/footer');
    }

    // Update Counter
    public function updateCounter($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->counterTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/counters'))->with('error', 'Record not found.');
        }

        $data = [
            'icon'  => $this->request->getPost('icon'),
            'count' => $this->request->getPost('count'),
            'title' => $this->request->getPost('title'),
        ];

        $model->updateRowById($this->counterTable, $id, $data);

        return redirect()->to(base_url('admin/counters'))->with('success', 'Counter Updated Successfully.');
    }

    // Delete Counter
    public function deleteCounter($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->counterTable, $id);

        if ($record) {
            $model->deleteRowById($this->counterTable, $id);
            return redirect()->to(base_url('admin/counters'))->with('success', 'Counter Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/counters'))->with('error', 'Delete failed.');
    }

    protected $teammembertable = 'team_members';

    // List all team members
    public function index()
    {
        $model = new FlyvistaModel();
        $data['members'] = $model->getTableData($this->teammembertable);

        return
            view('backend/templates/header') .
            view('backend/team-members', $data) .
            view('backend/templates/footer');
    }

    // Add Team Member Page
    public function add()
    {
        return
            view('backend/templates/header') .
            view('backend/add-team-member') .
            view('backend/templates/footer');
    }

    // Save Team Member
    public function save()
    {
        $model = new FlyvistaModel();
        $uploadImagePath = 'assets/img/team/';
        $uploadVideoPath = 'assets/videos/team/';

        // Handle image upload
        $imageName = '';
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move($uploadImagePath, $imageName);
        }

        // Handle video upload
        $videoName = '';
        $videoFile = $this->request->getFile('video');
        if ($videoFile && $videoFile->getSize() > 50 * 1024 * 1024) { // 50MB
            return redirect()->back()->with('error', 'Video size exceeds 50MB limit.');
        }

        $data = [
            'name'          => $this->request->getPost('name'),
            'role'          => $this->request->getPost('role'),
            'image'         => $imageName,
            'video'         => $videoName,
            'facebook_url'  => $this->request->getPost('facebook_url'),
            'twitter_url'   => $this->request->getPost('twitter_url'),
            'instagram_url' => $this->request->getPost('instagram_url'),
        ];

        $model->insertData($this->teammembertable, $data);

        return redirect()->to(base_url('admin/team-members'))->with('success', 'Team Member Added Successfully.');
    }

    // Edit Team Member Page
    public function edit($id)
    {
        $model = new FlyvistaModel();
        $data['member'] = $model->getRowById($this->teammembertable, $id);

        if (!$data['member']) {
            return redirect()->to(base_url('admin/team-members'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-team-member', $data) .
            view('backend/templates/footer');
    }

    // Update Team Member
    public function update($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->teammembertable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/team-members'))->with('error', 'Record not found.');
        }

        $uploadImagePath = 'assets/img/team/';
        $uploadVideoPath = 'assets/videos/team/';

        // Image
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            if (!empty($oldData['image']) && file_exists($uploadImagePath . $oldData['image'])) {
                unlink($uploadImagePath . $oldData['image']);
            }
            $imageName = $imageFile->getRandomName();
            $imageFile->move($uploadImagePath, $imageName);
        } else {
            $imageName = $oldData['image'];
        }

        // Video
        $videoFile = $this->request->getFile('video');
        if ($videoFile && $videoFile->isValid() && !$videoFile->hasMoved()) {
            if (!empty($oldData['video']) && file_exists($uploadVideoPath . $oldData['video'])) {
                unlink($uploadVideoPath . $oldData['video']);
            }
            $videoName = $videoFile->getRandomName();
            $videoFile->move($uploadVideoPath, $videoName);
        } else {
            $videoName = $oldData['video'];
        }

        $data = [
            'name'          => $this->request->getPost('name'),
            'role'          => $this->request->getPost('role'),
            'image'         => $imageName,
            'video'         => $videoName,
            'facebook_url'  => $this->request->getPost('facebook_url'),
            'twitter_url'   => $this->request->getPost('twitter_url'),
            'instagram_url' => $this->request->getPost('instagram_url'),
        ];

        $model->updateRowById($this->teammembertable, $id, $data);

        return redirect()->to(base_url('admin/team-members'))->with('success', 'Team Member Updated Successfully.');
    }

    // Delete Team Member
    public function delete($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->teammembertable, $id);

        $uploadImagePath = 'assets/img/team/';
        $uploadVideoPath = 'assets/videos/team/';

        if ($record) {
            if (!empty($record['image']) && file_exists($uploadImagePath . $record['image'])) {
                unlink($uploadImagePath . $record['image']);
            }
            if (!empty($record['video']) && file_exists($uploadVideoPath . $record['video'])) {
                unlink($uploadVideoPath . $record['video']);
            }

            $model->deleteRowById($this->teammembertable, $id);

            return redirect()->to(base_url('admin/team-members'))->with('success', 'Team Member Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/team-members'))->with('error', 'Delete failed.');
    }

    protected $successStoriesTable = 'success_stories';

    // List Success Stories
    public function successStories()
    {
        $model = new FlyvistaModel();
        $data['stories'] = $model->getTableData($this->successStoriesTable, [], 'id DESC'); // latest first

        return
            view('backend/templates/header') .
            view('backend/success-stories', $data) .
            view('backend/templates/footer');
    }

    // Add Success Story Page
    public function addSuccessStory()
    {
        return
            view('backend/templates/header') .
            view('backend/add-success-story') .
            view('backend/templates/footer');
    }

    // Save Success Story
    public function saveSuccessStory()
    {
        $model = new FlyvistaModel();
        $uploadPath = 'assets/img/courses/';

        // Upload Image
        $file = $this->request->getFile('image');
        $imageName = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move($uploadPath, $imageName);
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'role'        => $this->request->getPost('role'),
            'quote'       => $this->request->getPost('quote'),
            'course'      => $this->request->getPost('course'),
            'image'       => $imageName,
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
            'linkedin_url' => $this->request->getPost('linkedin_url')
        ];

        $model->insertData($this->successStoriesTable, $data);

        return redirect()->to(base_url('admin/success-stories'))->with('success', 'Story Added Successfully.');
    }

    // Edit Success Story Page
    public function editSuccessStory($id)
    {
        $model = new FlyvistaModel();
        $data['story'] = $model->getRowById($this->successStoriesTable, $id);

        if (!$data['story']) {
            return redirect()->to(base_url('admin/success-stories'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-success-story', $data) .
            view('backend/templates/footer');
    }

    // Update Success Story
    public function updateSuccessStory($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->successStoriesTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/success-stories'))->with('error', 'Record not found.');
        }

        $uploadPath = 'assets/img/courses/';
        $file = $this->request->getFile('image');
        $imageName = $oldData['image'];

        // Upload new image and delete old one
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($oldData['image'])) {
                $oldPath = $uploadPath . $oldData['image'];
                if (file_exists($oldPath)) unlink($oldPath);
            }
            $imageName = $file->getRandomName();
            $file->move($uploadPath, $imageName);
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'role'        => $this->request->getPost('role'),
            'quote'       => $this->request->getPost('quote'),
            'course'      => $this->request->getPost('course'),
            'image'       => $imageName,
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
            'linkedin_url' => $this->request->getPost('linkedin_url')
        ];

        $model->updateRowById($this->successStoriesTable, $id, $data);

        return redirect()->to(base_url('admin/success-stories'))->with('success', 'Story Updated Successfully.');
    }

    // Delete Success Story
    public function deleteSuccessStory($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->successStoriesTable, $id);
        $uploadPath = 'assets/img/courses/';

        if ($record) {
            if (!empty($record['image'])) {
                $path = $uploadPath . $record['image'];
                if (file_exists($path)) unlink($path);
            }

            $model->deleteRowById($this->successStoriesTable, $id);

            return redirect()->to(base_url('admin/success-stories'))->with('success', 'Story Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/success-stories'))->with('error', 'Delete failed.');
    }

    // ------------------------
    // COURSE DETAILS SECTION
    // ------------------------
    protected $courseDetailsTable = 'course_details';

    // List Course Details
    public function courseDetails()
    {
        $db = \Config\Database::connect();

        // JOIN course_details with courses table
        $builder = $db->table('course_details');
        $builder->select('course_details.*, courses.title as course_title');
        $builder->join('courses', 'courses.id = course_details.course_id', 'left');
        $builder->orderBy('course_details.id', 'DESC');

        $data['details'] = $builder->get()->getResult();

        return
            view('backend/templates/header') .
            view('backend/course-details', $data) .
            view('backend/templates/footer');
    }

    // Add Course Detail Page
    public function addCourseDetail()
    {
        $model = new FlyvistaModel();
        $data['courses'] = $model->getTableData('courses'); // for dropdown selection

        return
            view('backend/templates/header') .
            view('backend/add-course-detail', $data) .
            view('backend/templates/footer');
    }

    // Save Course Detail
    public function saveCourseDetail()
    {
        $model = new FlyvistaModel();

        $data = [
            'course_id'          => $this->request->getPost('course_id'),
            'about_title'        => $this->request->getPost('about_title'),
            'about_description'  => $this->request->getPost('description'),

            // Encode arrays into JSON
            'skills'             => json_encode($this->request->getPost('skills')),
            'training_methods'   => json_encode($this->request->getPost('training_methods')),
            'program_details'    => json_encode($this->request->getPost('program_details')),
            'eligibility'        => json_encode($this->request->getPost('eligibility')),
        ];

        $model->insertData($this->courseDetailsTable, $data);

        return redirect()->to(base_url('admin/course-details'))->with('success', 'Course Details Added Successfully.');
    }

    // Edit Course Detail Page
    public function editCourseDetail($id)
    {
        $model = new FlyvistaModel();

        $data['detail'] = $model->getRowById($this->courseDetailsTable, $id);
        $data['courses'] = $model->getTableData('courses'); // dropdown

        if (!$data['detail']) {
            return redirect()->to(base_url('admin/course-details'))->with('error', 'Record not found.');
        }

        // Decode JSON fields
        $data['detail']['skills']            = json_decode($data['detail']['skills'], true);
        $data['detail']['training_methods']  = json_decode($data['detail']['training_methods'], true);
        $data['detail']['program_details']   = json_decode($data['detail']['program_details'], true);
        $data['detail']['eligibility']       = json_decode($data['detail']['eligibility'], true);

        return
            view('backend/templates/header') .
            view('backend/edit-course-detail', $data) .
            view('backend/templates/footer');
    }

    // Update Course Detail
    public function updateCourseDetail($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->courseDetailsTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/course-details'))->with('error', 'Record not found.');
        }

        $data = [
            'course_id'          => $this->request->getPost('course_id'),
            'about_title'        => $this->request->getPost('about_title'),
            'about_description'  => $this->request->getPost('description'),

            // Encode as JSON
            'skills'             => json_encode($this->request->getPost('skills')),
            'training_methods'   => json_encode($this->request->getPost('training_methods')),
            'program_details'    => json_encode($this->request->getPost('program_details')),
            'eligibility'        => json_encode($this->request->getPost('eligibility')),
        ];

        $model->updateRowById($this->courseDetailsTable, $id, $data);

        return redirect()->to(base_url('admin/course-details'))->with('success', 'Course Details Updated Successfully.');
    }

    // Delete Course Detail
    public function deleteCourseDetail($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->courseDetailsTable, $id);

        if ($record) {
            $model->deleteRowById($this->courseDetailsTable, $id);
            return redirect()->to(base_url('admin/course-details'))->with('success', 'Course Details Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/course-details'))->with('error', 'Delete failed.');
    }

    // -----------------------------------------
    // BLOG DETAILS SECTION (Dynamic Sidebar)
    // -----------------------------------------
    protected $blogDetailsTable = 'blog_detail';

    // List Blog Details
    public function blogDetails()
    {
        $db = \Config\Database::connect();

        // JOIN blog_detail with blog_posts
        $builder = $db->table('blog_detail');
        $builder->select('blog_detail.*, blog_posts.title as blog_title');
        $builder->join('blog_posts', 'blog_posts.id = blog_detail.blog_post_id', 'left');
        $builder->orderBy('blog_detail.id', 'DESC');

        $data['details'] = $builder->get()->getResult();

        return
            view('backend/templates/header') .
            view('backend/blog-details', $data) .
            view('backend/templates/footer');
    }

    // Add Blog Detail Page
    public function addBlogDetail()
    {
        $model = new FlyvistaModel();
        $data['blogs'] = $model->getTableData('blog_posts'); // dropdown for blog selection

        return
            view('backend/templates/header') .
            view('backend/add-blog-detail', $data) .
            view('backend/templates/footer');
    }

    // Save Blog Detail
    public function saveBlogDetail()
    {
        $model = new FlyvistaModel();

        $data = [
            'blog_post_id'      => $this->request->getPost('blog_post_id'),
            'description'       => $this->request->getPost('description'),

            'aviation_fact'     => json_encode($this->request->getPost('aviation_fact')),
            'table_of_contents' => json_encode($this->request->getPost('table_of_contents')),
            'upcoming_courses'  => json_encode($this->request->getPost('upcoming_courses')),
            'simulator_specs'   => json_encode($this->request->getPost('simulator_specs')),
        ];

        $model->insertData($this->blogDetailsTable, $data);

        return redirect()
            ->to(base_url('admin/blog-details'))
            ->with('success', 'Blog Details Added Successfully.');
    }

    // Edit Blog Detail Page
    public function editBlogDetail($id)
    {
        $model = new FlyvistaModel();

        $data['detail'] = $model->getRowById($this->blogDetailsTable, $id);
        $data['blogs'] = $model->getTableData('blog_posts');

        if (!$data['detail']) {
            return redirect()
                ->to(base_url('admin/blog-details'))
                ->with('error', 'Record not found.');
        }

        // Decode JSON fields
        $data['detail']['aviation_fact']     = json_decode($data['detail']['aviation_fact'], true);
        $data['detail']['table_of_contents'] = json_decode($data['detail']['table_of_contents'], true);
        $data['detail']['upcoming_courses']  = json_decode($data['detail']['upcoming_courses'], true);
        $data['detail']['simulator_specs']   = json_decode($data['detail']['simulator_specs'], true);

        return
            view('backend/templates/header') .
            view('backend/edit-blog-detail', $data) .
            view('backend/templates/footer');
    }

    // Update Blog Detail
    public function updateBlogDetail($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->blogDetailsTable, $id);

        if (!$oldData) {
            return redirect()
                ->to(base_url('admin/blog-details'))
                ->with('error', 'Record not found.');
        }

        $data = [
            'blog_post_id'      => $this->request->getPost('blog_post_id'),
            'description'       => $this->request->getPost('description'),

            'aviation_fact'     => json_encode($this->request->getPost('aviation_fact')),
            'table_of_contents' => json_encode($this->request->getPost('table_of_contents')),
            'upcoming_courses'  => json_encode($this->request->getPost('upcoming_courses')),
            'simulator_specs'   => json_encode($this->request->getPost('simulator_specs')),
        ];

        $model->updateRowById($this->blogDetailsTable, $id, $data);

        return redirect()
            ->to(base_url('admin/blog-details'))
            ->with('success', 'Blog Details Updated Successfully.');
    }

    // Delete Blog Detail
    public function deleteBlogDetail($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->blogDetailsTable, $id);

        if ($record) {
            $model->deleteRowById($this->blogDetailsTable, $id);
            return redirect()
                ->to(base_url('admin/blog-details'))
                ->with('success', 'Blog Detail Deleted Successfully.');
        }

        return redirect()
            ->to(base_url('admin/blog-details'))
            ->with('error', 'Delete failed.');
    }

    protected $documentsTable = 'documents';

    // ------------------------------------------
    // List Documents
    // ------------------------------------------
    public function documents()
    {
        $model = new FlyvistaModel();
        $data['documents'] = $model->getTableData($this->documentsTable);

        return
            view('backend/templates/header') .
            view('backend/documents', $data) .
            view('backend/templates/footer');
    }

    // ------------------------------------------
    // Add Document Page
    // ------------------------------------------
    public function addDocument()
    {
        return
            view('backend/templates/header') .
            view('backend/add-document') .
            view('backend/templates/footer');
    }

    // ------------------------------------------
    // Save Document
    // ------------------------------------------
    public function saveDocument()
    {
        $model = new FlyvistaModel();

        $data = [
            'category'     => $this->request->getPost('category'),
            'document_name' => $this->request->getPost('document_name'),
            'is_optional'  => $this->request->getPost('is_optional') ? 1 : 0,
            'sort_order'   => $this->request->getPost('sort_order'),
        ];

        $model->insertData($this->documentsTable, $data);

        return redirect()->to(base_url('admin/documents'))
            ->with('success', 'Document Added Successfully.');
    }

    // ------------------------------------------
    // Edit Document Page
    // ------------------------------------------
    public function editDocument($id)
    {
        $model = new FlyvistaModel();
        $data['document'] = $model->getRowById($this->documentsTable, $id);

        if (!$data['document']) {
            return redirect()->to(base_url('admin/documents'))
                ->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-document', $data) .
            view('backend/templates/footer');
    }

    // ------------------------------------------
    // Update Document
    // ------------------------------------------
    public function updateDocument($id)
    {
        $model = new FlyvistaModel();
        $old = $model->getRowById($this->documentsTable, $id);

        if (!$old) {
            return redirect()->to(base_url('admin/documents'))
                ->with('error', 'Record not found.');
        }

        $data = [
            'category'     => $this->request->getPost('category'),
            'document_name' => $this->request->getPost('document_name'),
            'is_optional'  => $this->request->getPost('is_optional') ? 1 : 0,
            'sort_order'   => $this->request->getPost('sort_order'),
        ];

        $model->updateRowById($this->documentsTable, $id, $data);

        return redirect()->to(base_url('admin/documents'))
            ->with('success', 'Document Updated Successfully.');
    }

    // ------------------------------------------
    // Delete Document
    // ------------------------------------------
    public function deleteDocument($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->documentsTable, $id);

        if ($record) {
            $model->deleteRowById($this->documentsTable, $id);
            return redirect()->to(base_url('admin/documents'))
                ->with('success', 'Document Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/documents'))
            ->with('error', 'Delete failed.');
    }

    protected $faqTable = 'faqs';

    // List FAQs
    public function Faqs()
    {
        $model = new FlyvistaModel();

        // Fetch all FAQs
        $data['faqs'] = $model->getTableData($this->faqTable, [], 'id ASC', 0);

        return
            view('backend/templates/header') .
            view('backend/faq', $data) .
            view('backend/templates/footer');
    }

    // Add / Update / Delete FAQs
    public function updateFaqs()
    {
        $model = new FlyvistaModel();

        // ===== Update Existing =====
        $ids = $this->request->getPost('faq_ids');
        $questions = $this->request->getPost('questions');
        $answers = $this->request->getPost('answers');

        if ($ids && is_array($ids)) {
            foreach ($ids as $index => $id) {
                $model->updateRowById($this->faqTable, $id, [
                    'question' => $questions[$index],
                    'answer'   => $answers[$index]
                ]);
            }
        }

        // ===== Add New =====
        $newQuestions = $this->request->getPost('new_questions');
        $newAnswers = $this->request->getPost('new_answers');

        if ($newQuestions && is_array($newQuestions)) {
            foreach ($newQuestions as $index => $q) {
                $model->insertData($this->faqTable, [
                    'question' => $q,
                    'answer'   => $newAnswers[$index]
                ]);
            }
        }

        // ===== Delete Marked =====
        $deleteIds = $this->request->getPost('deleted_ids');
        if ($deleteIds && is_array($deleteIds)) {
            foreach ($deleteIds as $id) {
                $model->deleteRowById($this->faqTable, $id);
            }
        }

        return redirect()->to(base_url('admin/faqs'))->with('success', 'FAQs updated successfully.');
    }

    // Table name
    protected $contactMessagesTable = 'contact_messages';

    // Show Contact Messages
    public function contactMessages()
    {
        $model = new FlyvistaModel();

        // Get all submitted contact messages
        $data['contact_messages'] = $model->getTableData($this->contactMessagesTable, [], 'id DESC', 0);

        return view('backend/templates/header')
            . view('backend/contact-messages', $data)
            . view('backend/templates/footer');
    }

    protected $privacyTable = 'privacy_policy';

    // ------------------------------------------
    // List Privacy Policy Sections
    // ------------------------------------------
    public function privacyPolicies()
    {
        $model = new FlyvistaModel();
        $data['policies'] = $model->getTableData($this->privacyTable);

        return
            view('backend/templates/header') .
            view('backend/privacy-policies', $data) .
            view('backend/templates/footer');
    }

    // ------------------------------------------
    // Add Privacy Policy Page
    // ------------------------------------------
    public function addPrivacyPolicy()
    {
        return
            view('backend/templates/header') .
            view('backend/add-privacy-policy') .
            view('backend/templates/footer');
    }

    // ------------------------------------------
    // Save Privacy Policy
    // ------------------------------------------
    public function savePrivacyPolicy()
    {
        $model = new FlyvistaModel();

        $data = [
            'section'       => $this->request->getPost('section'),
            'heading'       => $this->request->getPost('heading'),
            'short_desc'    => $this->request->getPost('short_desc'),
            'card_title'    => $this->request->getPost('card_title'),
            'card_icon'     => $this->request->getPost('card_icon'),
            'card_content'  => $this->request->getPost('card_content'),
            'order_in_section' => $this->request->getPost('order_in_section'),
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        $model->insertData($this->privacyTable, $data);

        return redirect()->to(base_url('admin/privacy-policies'))
            ->with('success', 'Privacy Policy Added Successfully.');
    }

    // ------------------------------------------
    // Edit Privacy Policy Page
    // ------------------------------------------
    public function editPrivacyPolicy($id)
    {
        $model = new FlyvistaModel();
        $data['policy'] = $model->getRowById($this->privacyTable, $id);

        if (!$data['policy']) {
            return redirect()->to(base_url('admin/privacy-policies'))
                ->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-privacy-policy', $data) .
            view('backend/templates/footer');
    }

    // ------------------------------------------
    // Update Privacy Policy
    // ------------------------------------------
    public function updatePrivacyPolicy($id)
    {
        $model = new FlyvistaModel();
        $old = $model->getRowById($this->privacyTable, $id);

        if (!$old) {
            return redirect()->to(base_url('admin/privacy-policies'))
                ->with('error', 'Record not found.');
        }

        $data = [
            'section'       => $this->request->getPost('section'),
            'heading'       => $this->request->getPost('heading'),
            'short_desc'    => $this->request->getPost('short_desc'),
            'card_title'    => $this->request->getPost('card_title'),
            'card_icon'     => $this->request->getPost('card_icon'),
            'card_content'  => $this->request->getPost('card_content'),
            'order_in_section' => $this->request->getPost('order_in_section'),
        ];

        $model->updateRowById($this->privacyTable, $id, $data);

        return redirect()->to(base_url('admin/privacy-policies'))
            ->with('success', 'Privacy Policy Updated Successfully.');
    }

    // ------------------------------------------
    // Delete Privacy Policy
    // ------------------------------------------
    public function deletePrivacyPolicy($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->privacyTable, $id);

        if ($record) {
            $model->deleteRowById($this->privacyTable, $id);
            return redirect()->to(base_url('admin/privacy-policies'))
                ->with('success', 'Privacy Policy Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/privacy-policies'))
            ->with('error', 'Delete failed.');
    }


    protected $termsTable = 'terms';

    // List Terms & Conditions sections
    public function terms()
    {
        $model = new FlyvistaModel();
        $data['terms'] = $model->getTableData($this->termsTable, [], 'section, order_in_section');

        return
            view('backend/templates/header') .
            view('backend/terms', $data) .
            view('backend/templates/footer');
    }

    // Display Add Term page
    public function create()
    {
        return
            view('backend/templates/header') .
            view('backend/add-terms') .
            view('backend/templates/footer');
    }

    // Save new Term record
    public function store()
    {
        $model = new FlyvistaModel();

        $data = [
            'section'        => $this->request->getPost('section'),
            'heading'        => $this->request->getPost('heading'),
            'short_desc'     => $this->request->getPost('short_desc'),
            'card_title'     => $this->request->getPost('card_title'),
            'card_icon'      => $this->request->getPost('card_icon'),
            'card_content'   => $this->request->getPost('card_content'),
            'order_in_section' => $this->request->getPost('order_in_section'),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $model->insertData($this->termsTable, $data);

        return redirect()->to(base_url('admin/terms'))->with('success', 'Term Added Successfully.');
    }

    // Display Edit Term page
    public function editterms($id)
    {
        $model = new FlyvistaModel();
        $data['term'] = $model->getRowById($this->termsTable, $id);

        if (!$data['term']) {
            return redirect()->to(base_url('admin/terms'))->with('error', 'Record Not Found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-terms', $data) .
            view('backend/templates/footer');
    }

    // Update Term record
    public function updateterms($id)
    {
        $model = new FlyvistaModel();
        $old = $model->getRowById($this->termsTable, $id);

        if (!$old) {
            return redirect()->to(base_url('admin/terms'))->with('error', 'Record Not Found.');
        }

        $data = [
            'section'        => $this->request->getPost('section'),
            'heading'        => $this->request->getPost('heading'),
            'short_desc'     => $this->request->getPost('short_desc'),
            'card_title'     => $this->request->getPost('card_title'),
            'card_icon'      => $this->request->getPost('card_icon'),
            'card_content'   => $this->request->getPost('card_content'),
            'order_in_section' => $this->request->getPost('order_in_section'),
        ];

        $model->updateRowById($this->termsTable, $id, $data);

        return redirect()->to(base_url('admin/terms'))->with('success', 'Term Updated Successfully.');
    }

    // Delete Term record
    public function deleteterms($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->termsTable, $id);

        if ($record) {
            $model->deleteRowById($this->termsTable, $id);
            return redirect()->to(base_url('admin/terms'))->with('success', 'Term Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/terms'))->with('error', 'Delete failed.');
    }

    // ==========================================
    // Career Features Controller
    // ==========================================
    protected $careerFeaturesTable = 'career_features';

    // ------------------------------------------
    // List Career Features
    // ------------------------------------------
    public function careerFeatures()
    {
        $model = new FlyvistaModel();
        $data['career_features'] = $model->getTableData($this->careerFeaturesTable);

        return
            view('backend/templates/header') .
            view('backend/career-features', $data) .
            view('backend/templates/footer');
    }

    // ------------------------------------------
    // Add Career Feature Page
    // ------------------------------------------
    public function addCareerFeature()
    {
        return
            view('backend/templates/header') .
            view('backend/add-career-feature') .
            view('backend/templates/footer');
    }

    // ------------------------------------------
    // Save Career Feature
    // ------------------------------------------
    public function saveCareerFeature()
    {
        $model = new FlyvistaModel();

        $data = [
            'heading'     => $this->request->getPost('heading'),
            'short_desc'  => $this->request->getPost('short_desc'),
            'icon'        => $this->request->getPost('icon'),
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status') ? 1 : 0,
        ];

        $model->insertData($this->careerFeaturesTable, $data);

        return redirect()->to(base_url('admin/career-features'))
            ->with('success', 'Career Feature Added Successfully.');
    }

    // ------------------------------------------
    // Edit Career Feature Page
    // ------------------------------------------
    public function editCareerFeature($id)
    {
        $model = new FlyvistaModel();
        $data['career_feature'] = $model->getRowById($this->careerFeaturesTable, $id);

        if (!$data['career_feature']) {
            return redirect()->to(base_url('admin/career-features'))
                ->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-career-feature', $data) .
            view('backend/templates/footer');
    }

    // ------------------------------------------
    // Update Career Feature
    // ------------------------------------------
    public function updateCareerFeature($id)
    {
        $model = new FlyvistaModel();
        $old = $model->getRowById($this->careerFeaturesTable, $id);

        if (!$old) {
            return redirect()->to(base_url('admin/career-features'))
                ->with('error', 'Record not found.');
        }

        $data = [
            'heading'     => $this->request->getPost('heading'),
            'short_desc'  => $this->request->getPost('short_desc'),
            'icon'        => $this->request->getPost('icon'),
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status') ? 1 : 0,
        ];

        $model->updateRowById($this->careerFeaturesTable, $id, $data);

        return redirect()->to(base_url('admin/career-features'))
            ->with('success', 'Career Feature Updated Successfully.');
    }

    // ------------------------------------------
    // Delete Career Feature
    // ------------------------------------------
    public function deleteCareerFeature($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->careerFeaturesTable, $id);

        if ($record) {
            $model->deleteRowById($this->careerFeaturesTable, $id);
            return redirect()->to(base_url('admin/career-features'))
                ->with('success', 'Career Feature Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/career-features'))
            ->with('error', 'Delete failed.');
    }

    // ================================
    // JOBS (Open Positions)
    // ================================
    protected $jobsTable = 'jobs';


    // ------------------------------------------
    // List Jobs
    // ------------------------------------------
    public function jobs()
    {
        $model = new FlyvistaModel();
        $data['jobs'] = $model->getTableData($this->jobsTable);

        return
            view('backend/templates/header') .
            view('backend/jobs', $data) .
            view('backend/templates/footer');
    }


    // ------------------------------------------
    // Add Job Page
    // ------------------------------------------
    public function addJob()
    {
        return
            view('backend/templates/header') .
            view('backend/add-job') .
            view('backend/templates/footer');
    }


    // ------------------------------------------
    // Save Job
    // ------------------------------------------
    public function saveJob()
    {
        $model = new FlyvistaModel();

        $data = [
            'title'             => $this->request->getPost('title'),
            'location'          => $this->request->getPost('location'),
            'job_type'          => $this->request->getPost('job_type'),
            'category'          => $this->request->getPost('category'),
            'short_description' => $this->request->getPost('short_description'),
            'tags'              => $this->request->getPost('tags'), // JSON or comma string
            'job_description'   => $this->request->getPost('job_description'),
            'responsibilities'  => $this->request->getPost('responsibilities'),
            'requirements'      => $this->request->getPost('requirements'),
            'status'            => $this->request->getPost('status') ? 'active' : 'inactive',
        ];

        $model->insertData($this->jobsTable, $data);

        return redirect()->to(base_url('admin/jobs'))
            ->with('success', 'Job Added Successfully.');
    }


    // ------------------------------------------
    // Edit Job Page
    // ------------------------------------------
    public function editJob($id)
    {
        $model = new FlyvistaModel();
        $data['job'] = $model->getRowById($this->jobsTable, $id);

        if (!$data['job']) {
            return redirect()->to(base_url('admin/jobs'))
                ->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-job', $data) .
            view('backend/templates/footer');
    }


    // ------------------------------------------
    // Update Job
    // ------------------------------------------
    public function updateJob($id)
    {
        $model = new FlyvistaModel();
        $old = $model->getRowById($this->jobsTable, $id);

        if (!$old) {
            return redirect()->to(base_url('admin/jobs'))
                ->with('error', 'Record not found.');
        }

        $data = [
            'title'             => $this->request->getPost('title'),
            'location'          => $this->request->getPost('location'),
            'job_type'          => $this->request->getPost('job_type'),
            'category'          => $this->request->getPost('category'),
            'short_description' => $this->request->getPost('short_description'),
            'tags'              => $this->request->getPost('tags'),
            'job_description'   => $this->request->getPost('job_description'),
            'responsibilities'  => $this->request->getPost('responsibilities'),
            'requirements'      => $this->request->getPost('requirements'),
            'status'            => $this->request->getPost('status') ? 'active' : 'inactive',
        ];

        $model->updateRowById($this->jobsTable, $id, $data);

        return redirect()->to(base_url('admin/jobs'))
            ->with('success', 'Job Updated Successfully.');
    }


    // ------------------------------------------
    // Delete Job
    // ------------------------------------------
    public function deleteJob($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->jobsTable, $id);

        if ($record) {
            $model->deleteRowById($this->jobsTable, $id);
            return redirect()->to(base_url('admin/jobs'))
                ->with('success', 'Job Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/jobs'))
            ->with('error', 'Delete failed.');
    }

    protected $breadcrumbTable = 'breadcrumb_sections';

    // List Breadcrumb Sections
    public function breadcrumbSections()
    {
        $model = new FlyvistaModel();
        $data['sections'] = $model->getTableData($this->breadcrumbTable, [], 'id DESC'); // latest first

        return
            view('backend/templates/header') .
            view('backend/breadcrumb-sections', $data) .
            view('backend/templates/footer');
    }

    // Add Breadcrumb Section Page
    public function addBreadcrumbSection()
    {
        return
            view('backend/templates/header') .
            view('backend/add-breadcrumb-section') .
            view('backend/templates/footer');
    }

    // Save Breadcrumb Section
    public function saveBreadcrumbSection()
    {
        $model = new FlyvistaModel();
        $uploadPath = 'assets/img/breadcrumbs/'; // folder to store uploaded images

        // Handle File Upload
        $file = $this->request->getFile('bg_image');
        $imageName = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move($uploadPath, $imageName);
            $imageName = $uploadPath . $imageName; // save path in DB
        } else {
            return redirect()->back()->with('error', 'Background image is required.');
        }

        $data = [
            'slug'             => $this->request->getPost('slug'),
            'heading'          => $this->request->getPost('heading'),
            'breadcrumb_title' => $this->request->getPost('breadcrumb_title'),
            'bg_image'         => $imageName
        ];

        $model->insertData($this->breadcrumbTable, $data);

        return redirect()->to(base_url('admin/breadcrumb-sections'))->with('success', 'Breadcrumb Section Added Successfully.');
    }

    // Edit Breadcrumb Section Page
    public function editBreadcrumbSection($id)
    {
        $model = new FlyvistaModel();
        $data['section'] = $model->getRowById($this->breadcrumbTable, $id);

        if (!$data['section']) {
            return redirect()->to(base_url('admin/breadcrumb-sections'))->with('error', 'Record not found.');
        }

        return
            view('backend/templates/header') .
            view('backend/edit-breadcrumb-section', $data) .
            view('backend/templates/footer');
    }

    // Update Breadcrumb Section
    public function updateBreadcrumbSection($id)
    {
        $model = new FlyvistaModel();
        $oldData = $model->getRowById($this->breadcrumbTable, $id);

        if (!$oldData) {
            return redirect()->to(base_url('admin/breadcrumb-sections'))->with('error', 'Record not found.');
        }

        $uploadPath = 'assets/img/breadcrumbs/';
        $file = $this->request->getFile('bg_image');
        $imageName = $oldData['bg_image']; // default to old image

        // Handle new file upload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old image if exists
            if (!empty($oldData['bg_image']) && file_exists($oldData['bg_image'])) {
                unlink($oldData['bg_image']);
            }

            // Move new file
            $imageName = $file->getRandomName();
            $file->move($uploadPath, $imageName);
            $imageName = $uploadPath . $imageName; // save full path
        }

        $data = [
            'slug'             => $this->request->getPost('slug'),
            'heading'          => $this->request->getPost('heading'),
            'breadcrumb_title' => $this->request->getPost('breadcrumb_title'),
            'bg_image'         => $imageName
        ];

        $model->updateRowById($this->breadcrumbTable, $id, $data);

        return redirect()->to(base_url('admin/breadcrumb-sections'))->with('success', 'Breadcrumb Section Updated Successfully.');
    }

    // Delete Breadcrumb Section
    public function deleteBreadcrumbSection($id)
    {
        $model = new FlyvistaModel();
        $record = $model->getRowById($this->breadcrumbTable, $id);

        if ($record) {
            $model->deleteRowById($this->breadcrumbTable, $id);
            return redirect()->to(base_url('admin/breadcrumb-sections'))->with('success', 'Breadcrumb Section Deleted Successfully.');
        }

        return redirect()->to(base_url('admin/breadcrumb-sections'))->with('error', 'Delete failed.');
    }

    // Show Job Applications
    protected $jobApplicationsTable = 'job_applications';

    public function jobApplications()
    {
        $model = new FlyvistaModel();

        // Fetch ALL job applications (no limit)
        $data['job_applications'] = $model->getTableData($this->jobApplicationsTable, [], 'id', 0);

        return view('backend/templates/header')
            . view('backend/job-applications', $data)
            . view('backend/templates/footer');
    }

    // -------------------------------------------
    // COURSE APPLICATIONS – ADMIN LIST PAGE
    // -------------------------------------------

    protected $courseApplicationsTable = 'course_applications';

    /**
     * Display all course applications
     */
    public function courseApplications()
    {
        $model = new FlyvistaModel();

        // Fetch all course application records
        $data['course_applications'] = $model->getTableData(
            $this->courseApplicationsTable,
            [],
            'id',
            0
        );

        return view('backend/templates/header')
            . view('backend/course-applications', $data)
            . view('backend/templates/footer');
    }

    /**
     * Optional: Update/Delete course application
     * (You can expand this depending on your needs)
     */
    public function updateCourseApplication()
    {
        $model = new FlyvistaModel();

        $id = $this->request->getPost('id');
        $action = $this->request->getPost('action');

        if ($action == 'delete') {

            $deleted = $model->deleteRowById($this->courseApplicationsTable, $id);

            if ($deleted) {
                return redirect()->to('admin/course-applications')->with('success', 'Application deleted successfully.');
            } else {
                return redirect()->to('admin/course-applications')->with('error', 'Failed to delete application.');
            }
        }

        return redirect()->to('admin/course-applications');
    }
}
