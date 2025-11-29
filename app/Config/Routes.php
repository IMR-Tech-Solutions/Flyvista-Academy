<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('courses', 'Home::courses');
$routes->get('courses/(:segment)', 'Home::courseDetail/$1');
$routes->post('course-application-submit', 'Home::submitCourseApplication');
$routes->get('admission', 'Home::admission');
$routes->post('apply-admission', 'Home::saveAdmissionForm');
$routes->get('careers', 'Home::career');
$routes->post('submit-job-application', 'Home::submitJobApplication');
$routes->get('blog', 'Home::blog');
$routes->get('blog/(:segment)', 'Home::blogDetail/$1');
$routes->get('contact', 'Home::contact');
$routes->post('contact', 'Home::saveContactForm');
$routes->get('terms', 'Home::terms');
$routes->get('privacy-policy', 'Home::privacy');
$routes->post('submit-contact', 'Home::submitContact');
$routes->post('chatbot-api', 'Home::reply');


$routes->get('admin', 'FlyvistaAdminController::Admin_Dashboard');

$routes->get('signin', 'FlyvistaAdminController::signIn');
$routes->post('signin', 'FlyvistaAdminController::handleSignIn');
$routes->get('logout', 'FlyvistaAdminController::logout');

// Users Routes
$routes->get('admin/user', 'FlyvistaAdminController::User');
$routes->get('admin/user/add', 'FlyvistaAdminController::addUser');
$routes->post('admin/user/add', 'FlyvistaAdminController::saveUser');
$routes->get('admin/delete-user/(:num)', 'FlyvistaAdminController::deleteUser/$1');
$routes->get('admin/user/edit/(:num)', 'FlyvistaAdminController::editUser/$1');
$routes->post('admin/user/update/(:num)', 'FlyvistaAdminController::updateUser/$1');
$routes->get('admin/user/change-password/(:num)', 'FlyvistaAdminController::changePassword/$1');
$routes->post('admin/user/change-password/(:num)', 'FlyvistaAdminController::updatePassword/$1');

// Hero Section
$routes->get('admin/hero', 'FlyvistaAdminController::hero');
$routes->get('admin/hero/add', 'FlyvistaAdminController::addHero');
$routes->post('admin/hero/save', 'FlyvistaAdminController::saveHero');
$routes->get('admin/hero/edit/(:num)', 'FlyvistaAdminController::editHero/$1');
$routes->post('admin/hero/update/(:num)', 'FlyvistaAdminController::updateHero/$1');
$routes->get('admin/hero/delete/(:num)', 'FlyvistaAdminController::deleteHero/$1');

// ABOUT SECTION
$routes->get('admin/about', 'FlyvistaAdminController::about');
$routes->get('admin/about/add', 'FlyvistaAdminController::addAbout');
$routes->post('admin/about/save', 'FlyvistaAdminController::saveAbout');
$routes->get('admin/about/edit/(:num)', 'FlyvistaAdminController::editAbout/$1');
$routes->post('admin/about/update/(:num)', 'FlyvistaAdminController::updateAbout/$1');
$routes->get('admin/about/delete/(:num)', 'FlyvistaAdminController::deleteAbout/$1');

// COURSES SECTION
$routes->get('admin/courses', 'FlyvistaAdminController::courses');
$routes->get('admin/courses/add', 'FlyvistaAdminController::addCourse');
$routes->post('admin/courses/save', 'FlyvistaAdminController::saveCourse');
$routes->get('admin/courses/edit/(:num)', 'FlyvistaAdminController::editCourse/$1');
$routes->post('admin/courses/update/(:num)', 'FlyvistaAdminController::updateCourse/$1');
$routes->get('admin/courses/delete/(:num)', 'FlyvistaAdminController::deleteCourse/$1');

// ADMISSION PROCESS SECTION
$routes->get('admin/admission', 'FlyvistaAdminController::admissionProcess');
$routes->get('admin/admission/add', 'FlyvistaAdminController::addAdmissionStep');
$routes->post('admin/admission/save', 'FlyvistaAdminController::saveAdmissionStep');
$routes->get('admin/admission/edit/(:num)', 'FlyvistaAdminController::editAdmissionStep/$1');
$routes->post('admin/admission/update/(:num)', 'FlyvistaAdminController::updateAdmissionStep/$1');
$routes->get('admin/admission/delete/(:num)', 'FlyvistaAdminController::deleteAdmissionStep/$1');

// TESTIMONIALS SECTION
$routes->get('admin/testimonials', 'FlyvistaAdminController::testimonials');
$routes->get('admin/testimonials/add', 'FlyvistaAdminController::addTestimonial');
$routes->post('admin/testimonials/save', 'FlyvistaAdminController::saveTestimonial');
$routes->get('admin/testimonials/edit/(:num)', 'FlyvistaAdminController::editTestimonial/$1');
$routes->post('admin/testimonials/update/(:num)', 'FlyvistaAdminController::updateTestimonial/$1');
$routes->get('admin/testimonials/delete/(:num)', 'FlyvistaAdminController::deleteTestimonial/$1');

// BLOG SECTION
$routes->get('admin/blogs', 'FlyvistaAdminController::blogs');
$routes->get('admin/blogs/add', 'FlyvistaAdminController::addBlog');
$routes->post('admin/blogs/save', 'FlyvistaAdminController::saveBlog');
$routes->get('admin/blogs/edit/(:num)', 'FlyvistaAdminController::editBlog/$1');
$routes->post('admin/blogs/update/(:num)', 'FlyvistaAdminController::updateBlog/$1');
$routes->get('admin/blogs/delete/(:num)', 'FlyvistaAdminController::deleteBlog/$1');

// CONTACT INFO SECTION
$routes->get('admin/contact-info', 'FlyvistaAdminController::contactInfo');
$routes->get('admin/contact-info/add', 'FlyvistaAdminController::addContactInfo');
$routes->post('admin/contact-info/save', 'FlyvistaAdminController::saveContactInfo');
$routes->get('admin/contact-info/edit/(:num)', 'FlyvistaAdminController::editContactInfo/$1');
$routes->post('admin/contact-info/update/(:num)', 'FlyvistaAdminController::updateContactInfo/$1');
$routes->get('admin/contact-info/delete/(:num)', 'FlyvistaAdminController::deleteContactInfo/$1');

$routes->get('admin/contact-form', 'FlyvistaAdminController::contactForm');
$routes->post('admin/update-contact', 'FlyvistaAdminController::updateContact');

// MISSION & VISION SECTION
$routes->get('admin/mission-vision', 'FlyvistaAdminController::missionVision');
$routes->get('admin/mission-vision/add', 'FlyvistaAdminController::addMissionVision');
$routes->post('admin/mission-vision/save', 'FlyvistaAdminController::saveMissionVision');
$routes->get('admin/mission-vision/edit/(:num)', 'FlyvistaAdminController::editMissionVision/$1');
$routes->post('admin/mission-vision/update/(:num)', 'FlyvistaAdminController::updateMissionVision/$1');
$routes->get('admin/mission-vision/delete/(:num)', 'FlyvistaAdminController::deleteMissionVision/$1');

// WHY CHOOSE US SECTION
$routes->get('admin/why-choose', 'FlyvistaAdminController::whyChoose');
$routes->get('admin/why-choose/add', 'FlyvistaAdminController::addWhyChoose');
$routes->post('admin/why-choose/save', 'FlyvistaAdminController::saveWhyChoose');
$routes->get('admin/why-choose/edit/(:num)', 'FlyvistaAdminController::editWhyChoose/$1');
$routes->post('admin/why-choose/update/(:num)', 'FlyvistaAdminController::updateWhyChoose/$1');
$routes->get('admin/why-choose/delete/(:num)', 'FlyvistaAdminController::deleteWhyChoose/$1');

// counter
$routes->get('admin/counters', 'FlyvistaAdminController::counters');
$routes->get('admin/counters/add', 'FlyvistaAdminController::addCounter');
$routes->post('admin/counters/save', 'FlyvistaAdminController::saveCounter');
$routes->get('admin/counters/edit/(:num)', 'FlyvistaAdminController::editCounter/$1');
$routes->post('admin/counters/update/(:num)', 'FlyvistaAdminController::updateCounter/$1');
$routes->get('admin/counters/delete/(:num)', 'FlyvistaAdminController::deleteCounter/$1');

// Team Members
$routes->get('admin/team-members', 'FlyvistaAdminController::index');
$routes->get('admin/team-members/add', 'FlyvistaAdminController::add');
$routes->post('admin/team-members/save', 'FlyvistaAdminController::save');
$routes->get('admin/team-members/edit/(:num)', 'FlyvistaAdminController::edit/$1');
$routes->post('admin/team-members/update/(:num)', 'FlyvistaAdminController::update/$1');
$routes->get('admin/team-members/delete/(:num)', 'FlyvistaAdminController::delete/$1');

// SUCCESS STORIES SECTION
$routes->get('admin/success-stories', 'FlyvistaAdminController::successStories');
$routes->get('admin/success-stories/add', 'FlyvistaAdminController::addSuccessStory');
$routes->post('admin/success-stories/save', 'FlyvistaAdminController::saveSuccessStory');
$routes->get('admin/success-stories/edit/(:num)', 'FlyvistaAdminController::editSuccessStory/$1');
$routes->post('admin/success-stories/update/(:num)', 'FlyvistaAdminController::updateSuccessStory/$1');
$routes->get('admin/success-stories/delete/(:num)', 'FlyvistaAdminController::deleteSuccessStory/$1');

// COURSE DETAILS SECTION
$routes->get('admin/course-details', 'FlyvistaAdminController::courseDetails');
$routes->get('admin/course-details/add', 'FlyvistaAdminController::addCourseDetail');
$routes->post('admin/course-details/save', 'FlyvistaAdminController::saveCourseDetail');
$routes->get('admin/course-details/edit/(:num)', 'FlyvistaAdminController::editCourseDetail/$1');
$routes->post('admin/course-details/update/(:num)', 'FlyvistaAdminController::updateCourseDetail/$1');
$routes->get('admin/course-details/delete/(:num)', 'FlyvistaAdminController::deleteCourseDetail/$1');

// BLOG DETAILS SECTION
$routes->get('admin/blog-details', 'FlyvistaAdminController::blogDetails');
$routes->get('admin/blog-details/add', 'FlyvistaAdminController::addBlogDetail');
$routes->post('admin/blog-details/save', 'FlyvistaAdminController::saveBlogDetail');
$routes->get('admin/blog-details/edit/(:num)', 'FlyvistaAdminController::editBlogDetail/$1');
$routes->post('admin/blog-details/update/(:num)', 'FlyvistaAdminController::updateBlogDetail/$1');
$routes->get('admin/blog-details/delete/(:num)', 'FlyvistaAdminController::deleteBlogDetail/$1');

// Documents
$routes->get('admin/documents', 'FlyvistaAdminController::documents');
$routes->get('admin/documents/add', 'FlyvistaAdminController::addDocument');
$routes->post('admin/documents/save', 'FlyvistaAdminController::saveDocument');
$routes->get('admin/documents/edit/(:num)', 'FlyvistaAdminController::editDocument/$1');
$routes->post('admin/documents/update/(:num)', 'FlyvistaAdminController::updateDocument/$1');
$routes->get('admin/documents/delete/(:num)', 'FlyvistaAdminController::deleteDocument/$1');

// faq
$routes->get('admin/faqs', 'FlyvistaAdminController::Faqs');
$routes->post('admin/update-faqs', 'FlyvistaAdminController::updateFaqs');

// Career Features
$routes->get('admin/career-features', 'FlyvistaAdminController::careerFeatures');
$routes->get('admin/career-features/add', 'FlyvistaAdminController::addCareerFeature');
$routes->post('admin/career-features/save', 'FlyvistaAdminController::saveCareerFeature');
$routes->get('admin/career-features/edit/(:num)', 'FlyvistaAdminController::editCareerFeature/$1');
$routes->post('admin/career-features/update/(:num)', 'FlyvistaAdminController::updateCareerFeature/$1');
$routes->get('admin/career-features/delete/(:num)', 'FlyvistaAdminController::deleteCareerFeature/$1');

// Jobs (Open Positions)
$routes->get('admin/jobs', 'FlyvistaAdminController::jobs');
$routes->get('admin/jobs/add', 'FlyvistaAdminController::addJob');
$routes->post('admin/jobs/save', 'FlyvistaAdminController::saveJob');
$routes->get('admin/jobs/edit/(:num)', 'FlyvistaAdminController::editJob/$1');
$routes->post('admin/jobs/update/(:num)', 'FlyvistaAdminController::updateJob/$1');
$routes->get('admin/jobs/delete/(:num)', 'FlyvistaAdminController::deleteJob/$1');

// contact page
$routes->get('admin/contact-messages', 'FlyvistaAdminController::contactMessages');
$routes->post('admin/update-contact-message', 'FlyvistaAdminController::updateContactMessage');

// Privacy Policy CRUD
$routes->get('admin/privacy-policies', 'FlyvistaAdminController::privacyPolicies');
$routes->get('admin/privacy-policies/add', 'FlyvistaAdminController::addPrivacyPolicy');
$routes->post('admin/privacy-policies/save', 'FlyvistaAdminController::savePrivacyPolicy');
$routes->get('admin/privacy-policies/edit/(:num)', 'FlyvistaAdminController::editPrivacyPolicy/$1');
$routes->post('admin/privacy-policies/update/(:num)', 'FlyvistaAdminController::updatePrivacyPolicy/$1');
$routes->get('admin/privacy-policies/delete/(:num)', 'FlyvistaAdminController::deletePrivacyPolicy/$1');

// terms
$routes->get('admin/terms', 'FlyvistaAdminController::terms');
$routes->get('admin/terms/create', 'FlyvistaAdminController::create');
$routes->post('admin/terms/store', 'FlyvistaAdminController::store');
$routes->get('admin/terms/edit/(:num)', 'FlyvistaAdminController::editterms/$1');
$routes->post('admin/terms/update/(:num)', 'FlyvistaAdminController::updateterms/$1');
$routes->get('admin/terms/delete/(:num)', 'FlyvistaAdminController::deleteterms/$1');

// BREADCRUMB SECTIONS
$routes->get('admin/breadcrumb-sections', 'FlyvistaAdminController::breadcrumbSections');
$routes->get('admin/breadcrumb-sections/add', 'FlyvistaAdminController::addBreadcrumbSection');
$routes->post('admin/breadcrumb-sections/save', 'FlyvistaAdminController::saveBreadcrumbSection');
$routes->get('admin/breadcrumb-sections/edit/(:num)', 'FlyvistaAdminController::editBreadcrumbSection/$1');
$routes->post('admin/breadcrumb-sections/update/(:num)', 'FlyvistaAdminController::updateBreadcrumbSection/$1');
$routes->get('admin/breadcrumb-sections/delete/(:num)', 'FlyvistaAdminController::deleteBreadcrumbSection/$1');

// List all job applications
$routes->get('admin/job-applications', 'FlyvistaAdminController::jobApplications');

// Show Course Applications (Admin)
$routes->get('admin/course-applications', 'FlyvistaAdminController::courseApplications');