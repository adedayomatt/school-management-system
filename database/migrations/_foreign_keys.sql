ALTER TABLE students CHANGE enrollment_id enrollment_id INT UNSIGNED NOT NULL;
alter table `students` add index `students_enrollment_id_index`(`enrollment_id`);
alter table `students` add constraint `students_enrollment_id_foreign` foreign key (`enrollment_id`) references `enrollments` (`id`) on delete cascade;

ALTER TABLE parentts CHANGE enrollment_id enrollment_id INT UNSIGNED NOT NULL;
alter table `parentts` add index `parentts_enrollment_id_index`(`enrollment_id`);
alter table `parentts` add constraint `parentts_enrollment_id_foreign` foreign key (`enrollment_id`) references `enrollments` (`id`) on delete cascade;

ALTER TABLE student_attendances CHANGE student_id student_id INT UNSIGNED NOT NULL;
alter table `student_attendances` add index `student_attendances_student_id_index`(`student_id`);
alter table `student_attendances` add constraint `student_attendances_student_id_foreign` foreign key (`student_id`) references `students` (`id`) on delete cascade;

ALTER TABLE payments CHANGE student_id student_id INT UNSIGNED NOT NULL, CHANGE fee_id fee_id INT UNSIGNED NOT NULL;
alter table `payments` add index `payments_student_id_index`(`student_id`);
alter table `payments` add constraint `payments_student_id_foreign` foreign key (`student_id`) references `students` (`id`) on delete cascade;
alter table `payments` add index `payments_fee_id_index`(`fee_id`);
alter table `payments` add constraint `payments_fee_id_foreign` foreign key (`fee_id`) references `fees` (`id`) on delete cascade;

ALTER TABLE fee_student CHANGE student_id student_id INT UNSIGNED NOT NULL;
alter table `fee_student` add index `fee_student_student_id_index`(`student_id`);
alter table `fee_student` add constraint `fee_student_student_id_foreign` foreign key (`student_id`) references `students` (`id`) on delete cascade;

ALTER TABLE results CHANGE student_id student_id INT UNSIGNED NOT NULL;
alter table `results` add index `results_student_id_index`(`student_id`);
alter table `results` add constraint `results_student_id_foreign` foreign key (`student_id`) references `students` (`id`) on delete cascade;
