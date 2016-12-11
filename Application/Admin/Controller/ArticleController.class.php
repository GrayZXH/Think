<?php 
namespace Admin\Controller;
use Think\Controller;

class ArticleController extends Controller{
	public function index(){

        $data['status'] = array('eq',1);
        $artc=D('Article')->getArticleCount($data);
        
        $Page = new \Think\Page($count,20);
        $show = $Page->show();
        $offset = $Page->firstRow;
        $pagesize = $Page->listRows;
        $arts=D('Article')->getArticles($data,$offset,$pagesize);

        $this->assign('arts',$arts);
        $this->assign('show',$show);
		$this->assign('d','active');
		$this->display();
	}
	public function add(){
		if (IS_AJAX) {
    		$title    	= trans($_POST['title']);
    		$stitle     = trans($_POST['stitle']);
    		$description= trans($_POST['descript']);
    		$keywords	= trans($_POST['keyword']);
    		$content	= $_POST['content'];
    		$thum		= $_POST['thum'];
    		$class 		= trans($_POST['classmate']);
    		$status		= trans($_POST['status']);
    		$captcha	= trans($_POST['captcha']);
            $id         = $_POST['id']?trans($_POST['id']):null;

    		$res=check_verify($captcha, $id = '');
    		if (!$res||!$captcha) {
    			return show(0,'验证码错误！');
    		}
    		if(!$title){
    			return show(0,'标题不能为空！');
    		}
    		if (!$description) {
    			return show(0,'描述不能为空！');
    		}
    		if (!$keywords) {
    			return show(0,'关键词不能为空！');
    		}
    		if (is_null($content)) {
    			return show(0,'内容不能为空！');
    		}
    		if (!$thum) {
    			return show(0,'未上传缩略图！');
    		}
    		if (!$class) {
    			return show(0,'未选择分类！');
    		}

            $data['class']=$class;
            $data['title']=$title;
            $data['small_title']=$stitle;
            $data['description']=$description;
            $data['keywords']=$keywords;
            $data['thum']=$thum;
            $data['status']=$status;
            $data['username']=session('user.username');
            

            if (!$id) {
     			$articleid=D('Article')->addArticle($data);//用ThinkPHP中的add()方法  且如果主键是自动增长型 成功后返回值就是最新插入的值
                $contentid=D('Content')->addContent($content,$articleid);
     			if ($articleid&&$contentid) {
     				return show(1,'文章添加成功！');
     			}else{
     				return show(0,'文章添加失败！');
     			}
    		}
            if ($id) {
                $art=D('Article')->updateArticle($data,$id);//save方法的返回值是影响的记录数，如果返回false则表示更新出错，因此一定要用恒等来判断是否更新失败。
                $con=D('Content')->updateContent($content,$id);
                if ($articleid==false||$contentid==false) {
                    return show(0,'文章更新失败！');
                }else{
                    return show(1,'文章更新成功！');
                }
            }
    	}else{
            $title="添加文章";
            $this->assign('title',$title);
            $this->assign('d','active');
            $this->display();
        }
        
	}

    public function edit(){
        $id=trans($_GET['$id']);
        

        $article=D('Article')->getArticleById($id);
        $articlecon=D('Content')->getArticleContentById($id);

        $this->assign('article',$article);
        $this->assign('articlecon',$articlecon);

        $title="修改文章";
        $this->assign('title',$title);
        $this->assign('d','active');
        $this->display();
    }
    public function ban(){

        $data['status'] = array('eq',2);//文章的status等于2代表在草稿箱中，1代表在线文章，0，代表回收站中的文章
        $artc=D('Article')->getArticleCount($data);
        
        $Page = new \Think\Page($count,20);
        $show = $Page->show();
        $offset = $Page->firstRow;
        $pagesize = $Page->listRows;
        $arts=D('Article')->getArticles($data,$offset,$pagesize);

        $this->assign('arts',$arts);
        $this->assign('show',$show);
        $this->assign('d','active');
        $this->display();
    }
    public function trash(){

        $data['status'] = array('eq',0);//文章的status等于2代表在草稿箱中，1代表在线文章，0，代表回收站中的文章
        $artc=D('Article')->getArticleCount($data);
        
        $Page = new \Think\Page($count,20);
        $show = $Page->show();
        $offset = $Page->firstRow;
        $pagesize = $Page->listRows;
        $arts=D('Article')->getArticles($data,$offset,$pagesize);

        $this->assign('arts',$arts);
        $this->assign('show',$show);
        $this->assign('d','active');
        $this->display();
    }

	public function verify_c(){
        return captcha();
    }

}
?>
