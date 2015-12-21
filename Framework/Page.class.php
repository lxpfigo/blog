<?php
namespace Framework;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/3
 * Time: 10:24
 * 分页类
 */
class Page
{
    public function getPage($path, $totalNums, $pageNums = 11, $currentP, $showTotal = 5)
    {
        //每页个数
        $total = ceil($totalNums/$pageNums);

        if($pageNums >= $totalNums) {
            return '';
        }
        if($showTotal%2 == 0){
            $offsetPre = 1;
        }else {
            $offsetPre = 0;
        }
        $offset = floor($showTotal/2);//偏移量
        //上一页
        $str = '<nav style="text-align: center ">
				  <ul class="pagination">';
        if($currentP > 1){
            $str .= '<li>
					  <a href="'.$path.($currentP-1).'" aria-label="Previous" style="margin-left: 6px">
						<span aria-hidden="true">&laquo;</span>
					  </a>
					</li>';
        }

        //页码

//			$total (总页面数小于或等于）$showTotal（显示页码数)
        if($total <= $showTotal) {
            for ($i = 1; $i <= $total; $i++){
                if($i == $currentP){
                    $str .= '<li class="active"><a href="'.$path.$i.'" style="margin-left: 6px">'.$i.'</a></li>';
                }else {
                    $str .= '<li><a href="'.$path.$i.'" style="margin-left: 6px">'.$i.'</a></li>';
                }
            }
        }else {
            //总页码数大于显示页码数
            //如果当前页面小于等于$showTotal减去偏移量
            if($currentP <= $showTotal - $offset) {
                for ($i = 1; $i <= $showTotal; $i++) {
                    if($i == $currentP){
                        $str .= '<li class="active"><a href="'.$path.$i.'" style="margin-left: 6px">'.$i.'</a></li>';
                    }else {
                        $str .= '<li><a href="'.$path.$i.'" style="margin-left: 6px">'.$i.'</a></li>';
                    }
                }
            }
            //如果当前页面大于$showTotal减去偏移量 并且小于或等于总页码数$total-$offset
            if($currentP > $showTotal - $offset && $currentP <= $total - $offset) {
                for ($i = $currentP - $offset + $offsetPre; $i <= $currentP + $offset; $i++) {
                    if($i == $currentP){
                        $str .= '<li class="active"><a href="'.$path.$i.'" style="margin-left: 6px">'.$i.'</a></li>';
                    }else {
                        $str .= '<li><a href="'.$path.$i.'" style="margin-left: 6px">'.$i.'</a></li>';
                    }
                }
            }
            //如果当前页面大于总页码数$total-$offset
            if($currentP > $total - $offset) {
                for ($i = $total - $showTotal + 1; $i <= $total; $i++) {
                    if($i == $currentP){
                        $str .= '<li class="active"><a href="'.$path.$i.'" style="margin-left: 6px">'.$i.'</a></li>';
                    }else {
                        $str .= '<li><a href="'.$path.$i.'" style="margin-left: 6px">'.$i.'</a></li>';
                    }
                }
            }
        }
        //下一页
        if($currentP < $total){
            $str .= '<li>
					  <a href="'.$path.($currentP+1).'" aria-label="Next" style="margin-left: 6px">
						<span aria-hidden="true">&raquo;</span>
					  </a>
					</li>
				  </ul>
				</nav>';
        }
        return $str;
    }
}