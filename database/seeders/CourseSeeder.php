<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Course;
use App\Models\Topic;
use App\Models\Activity;
use App\Models\User;

use App\Models\TypesActivities\H5P;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course = Course::create([
            'name' => 'Internet of Things',
        ]);

        $topics = [
            [
                'name' => 'Lesson 1: Course details',
                'activities' => [
                    [
                        'name' => 'Course Overview',
                        'content' => H5P::make([
                            'link' => 'https://vuwcourses.h5p.com/content/1291628815245990239',
                        ]),
                    ],
                ]
            ],
            [
                'name' => 'Lesson 2: What is IoT?',
                'activities' => [
                    [
                        'name' => 'Introduction to IoT',
                        'content' => H5P::make([
                            'link' => 'https://vuwcourses.h5p.com/content/1291616859351462409',
                        ]),
                    ],
                    [
                        'name' => 'Extension - Intro to IoT',
                        'required' => false,
                        'content' => H5P::make([
                            'link' => 'https://vuwcourses.h5p.com/content/1291616864977532379',
                        ]),
                    ],
                ]
            ],
            [
                'name' => 'Lesson 3: Use cases of IoT',
                'activities' => [
                    [
                        'name' => 'Use Cases of IoT',
                        'content' => H5P::make([
                            'link' => 'https://vuwcourses.h5p.com/content/1291617718878129779',
                        ]),
                    ],
                    [
                        'name' => 'Quiz',
                        'content' => H5P::make([
                            'link' => 'https://vuwcourses.h5p.com/content/1291617734559256809',
                        ]),
                    ],
                    [
                        'name' => 'Spark Story',
                        'content' => H5P::make([
                            'link' => 'https://vuwcourses.h5p.com/content/1291617729659258209',
                        ]),
                    ],
                    [
                        'name' => 'Examples of IoT around you',
                        'content' => H5P::make([
                            'link' => 'https://vuwcourses.h5p.com/content/1291617737948037429',
                        ]),
                    ],
                ]
            ],
            [
                'name' => 'Lesson 4: How it works',
                'activities' => [
                    /*[
                        'name' => '',
                        'content' => H5P::make([
                            'link' => '',
                        ]),
                    ],*/
                ]
            ],
            [
                'name' => 'Lesson 5: Intro to Microbit',
                'activities' => []
            ],
            [
                'name' => 'Lesson 6: Intro to IoT Shield',
                'activities' => []
            ],
            [
                'name' => 'Lesson 7: Project',
                'activities' => []
            ],
        ];

        foreach ($topics as $topic) {
            // Make topic
            $t = Topic::create([
                'name' => $topic['name'],
                'course_id' => $course->id,
            ]);

            // Add topic to course
            $course->topics()->save($t);

            foreach ($topic['activities'] as $activity) {
                $c = $activity['content'];

                $a = Activity::create([
                    'name' => $activity['name'],
                    'topic_id' => $t->id,
                    'link' => $c->link,
                    'activityable_type' => get_class($c)
                ]);

                // Save activity to topics
                $t->activities()->save($a);
            }
        }

        // Add every user to this course.
        $course->users()->saveMany(User::all());
    }
}
