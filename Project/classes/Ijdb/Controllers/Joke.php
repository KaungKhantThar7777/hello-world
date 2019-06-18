<?php 
	namespace Ijdb\Controllers;
	use \Ninja\DatabaseTable;
	use \Ninja\Authentication;
	class Joke
	{
		private $authorTable;
		private $jokeTable;
		private $authentication;
		public function __construct(DatabaseTable $joke,DatabaseTable $author,Authentication $authentication)
		{
			$this->authorTable=$author;
			$this->jokeTable=$joke;
			$this->authentication=$authentication;
		}

		public function delete()
		{
			$author=$this->authentication->getUser();
			$joke=$this->jokeTable->findById($_POST['id']);

			if($author['id'] != $joke['authorid'])
				return;
			$this->jokeTable->delete($_POST['id']);
		
		header('Location:/joke/list');
		}
		public function saveEdit()
		{
			$author=$this->authentication->getUser();
			if(isset($_GET['id']))
			{
				$joke=$this->jokeTable->findById($_GET[id]);

				if($author['id'] != $joke['authorid'])
					return;
			}
			$joke=$_POST['joke'];
			$joke['authorid']=$this->authentication->getUser()['id'];
			$joke['jokedate']=new \DateTime();

			$this->jokeTable->save($joke);

			header('Location:/joke/list');
		}
		public function edit()
		{
			$currentUsr=$this->authentication->getUser();
					if(isset($_GET['id']))
					{
						$joke=$this->jokeTable->findById($_GET['id']);
						
					}
						$title='Edit joke';
						return ['title'=>$title,'template'=>'editjoke.html.php','variables'=>['joke'=>$joke ?? null,
																								'userId'=>$currentUsr['id']]];
		}
					
			public function list()
			{

				$total=$this->jokeTable->total();
				
				$result=$this->jokeTable->findAll();
				$jokes=[];
				foreach($result as $joke)
				{
					$author=$this->authorTable->findById($joke['authorid']);
					$jokes[]=[
								'id'=>$joke['id'],
								'joketext'=>$joke['joketext'],
								'jokedate'=>$joke['jokedate'],
								'authorId'=>$author['id'],
								'name'=>$author['name'],
								'email'=>$author['email']
							];
				}
				$currentUsr=$this->authentication->getUser();
				$title="Jokes List";
				return ['title'=>$title,
					'template'=>'jokes.html.php',
					'variables'=>['jokes'=>$jokes,'total'=>$total,
					'userId'=>$currentUsr['id'] ?? null]];
			}
			public function home()
			{
				$title='Internet Joke Database';
				return ['title'=>$title,'template'=>'home.html.php'];
			}
		}
 ?>