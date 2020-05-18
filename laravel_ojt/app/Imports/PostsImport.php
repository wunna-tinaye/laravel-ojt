<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PostsImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        if (!empty($row['id'])) {
            $post = Post::find($row['id']);
            if (empty($post) || (!empty($post) && $post->create_user_id != auth()->user()->id)) {
                return new Post([
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'status' => $row['status'],
                    'create_user_id' => auth()->user()->id,
                    'updated_user_id' => auth()->user()->id,
                ]);
            } else {
                Post::where('id', $post->id)->update([
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'status' => $row['status'],
                    'updated_user_id' => auth()->user()->id,
                ]);
            }
        } else {
            return new Post([
                'title' => $row['title'],
                'description' => $row['description'],
                'status' => $row['status'],
                'create_user_id' => $row['create_user_id'],
                'updated_user_id' => $row['updated_user_id'],
            ]);
        }

    }

    /**
     * Rule function for validation
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255|unique:posts',
            'description' => 'required',
        ];
    }
}
