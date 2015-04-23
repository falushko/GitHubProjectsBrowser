<?php

namespace app\models;

use yii\base\Model;
use app\models\Users;
use app\models\Repos;

class SearchForm extends Model
{
    public $search;
    
    public function rules()
    {
        return [
            ['search','required', 'message' => '']
        ];
    }

// Getting repos for search phrase
    public function getRepositories()
    {
    	$client = new \Github\Client();
        $searchPhrase = $this->search;
    	$result;
		$repositories = $client->api('repo')->find($searchPhrase);
        foreach($repositories['repositories'] as $key => $value){
                $result[$key]['name'] = $value['name'];
                $result[$key]['homepage'] = $value['homepage'];
                $result[$key]['owner'] = $value['owner'];
                $result[$key]['watchers'] = $value['watchers'];
                $result[$key]['forks'] = $value['forks'];
                $result[$key]['description'] = $value['description'];
                $result[$key]['liked'] = Repos::findAll("{$value['owner']}/{$value['name']}");
                $result[$key]['search_phrase'] = $searchPhrase; 
            }
        return $result;
    }

// Getting repos for search phrase. Neded when user clicks "Like!" and page refreshes. 
// Repeating code, needs for refactoring
    public function getRepositoriesWithSearchPhrase($phrase)
    {
        $client = new \Github\Client();
        $result;
        $repositories = $client->api('repo')->find($phrase);
        foreach($repositories['repositories'] as $key => $value){
                $result[$key]['name'] = $value['name'];
                $result[$key]['homepage'] = $value['homepage'];
                $result[$key]['owner'] = $value['owner'];
                $result[$key]['watchers'] = $value['watchers'];
                $result[$key]['forks'] = $value['forks'];
                $result[$key]['description'] = $value['description'];
                $result[$key]['liked'] = Repos::findAll("{$value['owner']}/{$value['name']}");
                $result[$key]['search_phrase'] = $phrase; 
            }
        return $result;
    }

// Get repository details
    public static function getRepoDetails($owner, $name)
    {
    	$client = new \Github\Client();
    	$repository = $client->api('repo')->show($owner, $name);
        $result['description'] = $repository['description'];
        $result['watchers'] = $repository['watchers_count'];
        $result['forks'] = $repository['forks'];
        $result['issues'] = $repository['open_issues'];
        $result['homepage'] = $repository['homepage'];
        $result['github_repo'] = "https://github.com/" . $repository['full_name'];
        $result['created_at'] = $repository['created_at'];
        $result['name'] = $repository['full_name'];
        $result['owner'] = $owner;
        $result['sName'] = $name;
        $result['contributors'] = $client->api('repo')->contributors($owner, $name, true);
        $result['liked'] = Users::find('login')->all();
    	return $result;
    }

// Ger user details
    public static function getUserDetails($user)
    {
        $client = new \Github\Client();
        $result = $client->api('user')->show($user);
        $result['login'] = $result['login'];
        $result['name'] = $result['name'];
        $result['avatar_url'] = $result['avatar_url'];
        $result['company'] = $result['company'];
        $result['blog'] = $result['blog'];
        $result['followers'] = $result['followers'];
        $result['liked'] = Users::findOne($user);
        return $result;
    }

// Creating/deleting liked user in Users table
    public function userLikeUnlike($login)
    {
        $user = Users::findOne($login);
        if(!empty($user)){
            $user->delete();
        } else{
            $user = new Users;
            $user->login = $login;
            $user->save();
        }
    }

// Creating/deleting liked repository in Repos table
    public function repoLikeUnlike($repo)
    {
        $rp = Repos::findOne($repo);
        if(!empty($rp)){
            $rp->delete();
        } else{
            $rp = new Repos;
            $rp->repo = $repo;
            $rp->save();
        }
    }
}