<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\FormAnswers
 *
 * @property int $id
 * @property int $user_id
 * @property int $form_questions_id
 * @property mixed $questions
 * @property mixed $answers
 * @property string $submitted_at
 * @property int $group_user_id
 * @property int|null $unity_assessment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Form|null $form
 * @property-read \App\Models\UnityAssessment|null $unityAssessment
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\FormAnswersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers query()
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereFormQuestionsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereGroupUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereUnityAssessmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereUserId($value)
 * @mixin \Eloquent
 * @property int $form_id
 * @property int|null $group_id
 * @property int|null $teacher_id
 * @property float|null $first_competence_average
 * @property float|null $second_competence_average
 * @property float|null $third_competence_average
 * @property float|null $fourth_competence_average
 * @property float|null $fifth_competence_average
 * @property float|null $sixth_competence_average
 * @property-read \App\Models\Group|null $group
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereFifthCompetenceAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereFirstCompetenceAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereFourthCompetenceAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereSecondCompetenceAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereSixthCompetenceAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormAnswers whereThirdCompetenceAverage($value)
 */
class FormAnswers extends Model
{
    use HasFactory;
    protected $table = 'form_answers';
    protected $guarded = [];

    public static function getCurrentFormAnswers(): \Illuminate\Support\Collection
    {
        return DB::table('form_answers as fa')
            ->select(['fa.id', 'fa.submitted_at', 'u.name as studentName', 't.name as teacherName','g.name as groupName', 'fa.first_competence_average','fa.second_competence_average','fa.third_competence_average','fa.fourth_competence_average','fa.fifth_competence_average','fa.sixth_competence_average'])
            ->join('forms as f', 'fa.form_id', '=', 'f.id')
            ->join('users as u', 'fa.user_id', '=', 'u.id')
            ->join('users as t', 'fa.teacher_id', '=', 't.id')
            ->join('groups as g', 'fa.group_id', '=', 'g.group_id')
            ->get();
    }

}
