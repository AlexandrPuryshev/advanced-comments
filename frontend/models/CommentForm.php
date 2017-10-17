<?php
namespace frontend\models;

use common\models\db\Comment;
use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    /**
     * @var null|string action формы
     */
    public $action = null;
    /**
     * @var int|null идентификатор родительского комментария
     */
    public $parentId = null;
    /**
     * @var int|null идентификатор поста
     */
    public $postId = null;
    /**
     * @var string контент комментария
     */
    public $content;

    public function __construct($action = null)
    {
        $this->action = $action;
        $data = parse_url($action, PHP_URL_QUERY);
        parse_str($data, $output);
        $this->postId = $output['id'][0];
        parent::__construct();
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parentId', 'postId'], 'integer'],
            [['content'], 'string', 'max' => 255]
        ];
    }
    public function attributeLabels()
    {
        return [
            'content' => 'Add new comment'
        ];
    }
    /**
     * Сохраняет комментарий.
     * @param Comment $comment модель комментария
     * @param array $data данные пришедшие из формы
     * @return bool
     */
    public static function save(Comment $comment, array $data)
    {
        $isLoad = $comment->load([
            'postId' => $data['postId'],
            'content' => $data['content']
        ], '');
        return ($isLoad && $comment->save());
    }
}