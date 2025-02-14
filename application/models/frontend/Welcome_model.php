<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Welcome_model extends CI_Model

{

    function __construct()

    {

        parent::__construct();

    }

    function get_cms_page_details($page_id = 1)

    {

        $result_array = array();

        $this->db->select('t.*');

        $this->db->from(TBL_CMS_PAGES . ' t');

        $where_tour_data = array('t.status' => 1, 't.id' => $page_id);

        $this->db->where($where_tour_data);

        $query = $this->db->get();

        $result_array = $query->row_array();

        return $result_array;

    }
    function get_cms_page_details_slug($search = 'review')

    {

        $result_array = array();

        $this->db->select('t.*');

        $this->db->from(TBL_CMS_PAGES . ' t');

        $where_tour_data = array('t.status' => 1);

        $this->db->where($where_tour_data);
        $this->db->like('t.slug', $search);
        $query = $this->db->get();

        $result_array = $query->row_array();

        return $result_array;

    }

    function get_tour_list_by_city_slug($city_slug = 1, $tour_type_array = [], $small_group_tours_in_city_tours = false)

    {

        $result_array = array();

        $this->db->select('t.id as tour_id, t.title as tour_title, t.tour_category_id, t.tour_type_id, t.duration, t.rating, t.feature_image, t.top_selling_tour , t.status, t.unique_code, t.slug as tour_slug, t.meta_title, t.is_city_tour, t.video_url, tc.id as as_tour_category_id, tc.title as tour_category_title, tc.slug as tour_category_slug, tc.feature_image as tour_feature_image,  tt.title as tour_type_title, tt.id as tour_type_table_id');



        $this->db->from(TBL_TOUR . ' t');

        $this->db->join(TBL_TOUR_CATEGORY . ' tc', 'tc.id  = t.tour_category_id ', 'left');

        $this->db->join(TBL_TOUR_TYPE . ' tt', 'tt.id  = t.tour_type_id ', 'left');

        $where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 'tc.slug' => $city_slug);

        // if ($is_city_tours)

        //     $where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 'tc.slug' => $city_slug, 't.is_city_tour' => 1);



        $this->db->where($where_tour_data);

        $this->db->where_in('tt.id', $tour_type_array);

        if ($small_group_tours_in_city_tours)

            $this->db->or_where('`t`.`id` IN (SELECT `t`.`id` FROM `' . TBL_TOUR . '` WHERE `tt`.`id`=7 AND `t`.`is_city_tour` = 1 AND `tc`.`slug` = "' . $city_slug . '")', NULL, FALSE);



        $this->db->group_by(array('t.id')); // add group_by

        $this->db->order_by('t.title', "asc");

        $this->db->query("SET sql_mode = '' ");

        $query = $this->db->get();

        // query(1);

        $result_array = $query->result_array();

        return $result_array;

    }

    function get_transfer_tour_list_by_city_slug($city_slug = 1, $tour_type_array = [])

    {

        $result_array = array();

        $this->db->select('t.id as tour_id, t.title as tour_title, t.tour_category_id, t.tour_type_id, t.duration, t.rating, t.feature_image, t.top_selling_tour , t.status, t.unique_code, t.slug as tour_slug, t.meta_title, t.is_city_tour, tc.id as as_tour_category_id, tc.title as tour_category_title, tc.slug as tour_category_slug, tc.feature_image as tour_feature_image,  tt.title as tour_type_title, tt.id as tour_type_table_id');



        $this->db->from(TBL_TOUR . ' t');

        $this->db->join(TBL_TOUR_CATEGORY . ' tc', 'tc.id  = t.tour_category_id ', 'left');

        $this->db->join(TBL_TOUR_TYPE . ' tt', 'tt.id  = t.tour_type_id ', 'left');

        $where_tour_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 'tc.slug' => $city_slug);



        $this->db->where($where_tour_data);

        $this->db->where_in('tt.id', $tour_type_array);

        $this->db->or_where('`t`.`id` IN (SELECT `t`.`id` FROM `' . TBL_TOUR . '` WHERE `tt`.`id`=7 AND `t`.`is_city_tour` = 1 AND `tc`.`slug` = "' . $city_slug . '")', NULL, FALSE);



        $this->db->group_by(array('t.id')); // add group_by

        $this->db->order_by('t.title', "asc");

        $this->db->query("SET sql_mode = '' ");

        $query = $this->db->get();

        // query(1);

        $result_array = $query->result_array();

        return $result_array;

    }

    function get_transfers_list_by_city_slug($city_slug = 1, $transfer_type_array = '')

    {

        $result_array = array();

        $this->db->select('t.id as transfer_id, t.title as transfer_title, t.transfer_category_id, t.transfer_type_id, t.duration, t.ratings, t.status, t.unique_code, t.description as transfer_description, t.feature_image as transfer_feature_image, tc.feature_image as transfer_category_feature_image, tc.id as as_transfer_category_id, tc.title as transfer_category_title, tc.slug as transfer_category_slug,  tt.title as transfer_type_title, tt.id as transfer_type_table_id');

        $this->db->from(TBL_TRANSFER . ' t');

        $this->db->join(TBL_TRANSFER_CATEGORY . ' tc', 'tc.id  = t.transfer_category_id ', 'left');

        $this->db->join(TBL_TRANSFER_TYPE . ' tt', 'tt.id  = t.transfer_type_id ', 'left');

        $where_transfer_data = array('t.status' => 1, 'tc.status' => 1, 'tt.status' => 1, 'tc.slug' => $city_slug);

        $this->db->where($where_transfer_data);

        $this->db->where_in('tt.id', $transfer_type_array);

        $this->db->group_by('t.id'); // add group_by   

        $this->db->order_by('t.title', "asc");

        $this->db->query("SET sql_mode = '' ");

        $query = $this->db->get();

        $result_array = $query->result_array();

        return $result_array;

    }

    function update_user($user_id, $postData, $subscribe_user = '')

    {

        $this->db->where('id', $user_id);

        if (!empty($subscribe_user)) {

            $this->db->where('subscribe', $subscribe_user);

        }

        $this->db->update(TBL_USERS, $postData);

        if ($this->db->affected_rows() == '1')

            return true;

        else

            return false;

    }

    function get_users($where_users)

    {

        $this->db->select(TBL_USERS . '.id,' . TBL_USERS . '.name,' . TBL_USERS . '.email,' . TBL_USERS . '.subscribe_email_content,' . TBL_USERS . '.token');

        $this->db->from(TBL_USERS);

        if (!empty($where_users))

            $this->db->where($where_users);



        $query = $this->db->get();

        $row = $query->result_array();

        return $row;

    }



    function insert_user($user_data)

    {

        if ($this->db->insert(TBL_USERS, $user_data)) {

            return TRUE;

        } else {

            return TRUE;

        }

    }

    function get_newsletter_content()

    {

        $result_array = array();

        $this->db->select('nl.id, nl.user_id, nl.email_content, nl.newsletter_subject, nl.tour_image1_url, nl.tour_image2_url, nl.tour_image_1, nl.tour_image_2,nl.newsletter_content_2, nl.status, u.name, u.email, u.token, u.id as tbl_user_id');

        $this->db->from(TBL_NEWSLETTER_EMAILS . ' nl');

        $this->db->join(TBL_USERS . ' u', 'u.id  = nl.user_id ', 'left');

        $this->db->where(array('nl.status' => 0));

        // $this->db->where('nl.id <=', 6766);

        // $this->db->where('nl.id >=', 6746);

        $this->db->group_by('nl.id'); // add group_by   

        $this->db->order_by('nl.created_at', "desc");

        $this->db->limit(50);

        $this->db->query("SET sql_mode = '' ");

        $query = $this->db->get();

        $result_array = $query->result_array();

        return $result_array;

    }

    function update_newsletter($newsletter_id)

    {

        $this->db->where('id', $newsletter_id);

        $this->db->update(TBL_NEWSLETTER, array('status' => 1));

    }

    function get_blogs_with_categories($where_id = '', $where_slug = '', $limit = '', $search = '', $pagination = '')

    {

        $method = 'result_array';

        $this->db->select(TBL_BLOGS . '.*, ' . TBL_BLOGS . '.id as blog_id, GROUP_CONCAT(' . TBL_BLOG_CATEGORIES . '.slug ORDER BY ' . TBL_BLOG_CATEGORIES . '.id SEPARATOR ",") as "cat_slug" , GROUP_CONCAT(' . TBL_BLOG_CATEGORIES . '.name ORDER BY ' . TBL_BLOG_CATEGORIES . '.id SEPARATOR ",") as "categories"');

        $this->db->from(TBL_BLOGS);

        // if($where_ids){

        // $this->db->where_in(array(TBL_BLOGS.'.category_ids' => $where_ids));

        // foreach($where_ids as single)

        $this->db->join(TBL_BLOG_CATEGORIES, TBL_BLOG_CATEGORIES . '.id = SUBSTRING_INDEX(SUBSTRING_INDEX(' . TBL_BLOGS . '.category_ids, ",", FIND_IN_SET(' . TBL_BLOG_CATEGORIES . '.id, ' . TBL_BLOGS . '.category_ids)), ",", -1)');

        // }else{

        // $this->db->join(TBL_BLOG_CATEGORIES, TBL_BLOG_CATEGORIES.'.id = SUBSTRING_INDEX(SUBSTRING_INDEX('.TBL_BLOGS.'.category_ids, ",", FIND_IN_SET('.TBL_BLOG_CATEGORIES.'.id, '.TBL_BLOGS.'.category_ids)), ",", -1)');

        // }

        // if($where_ids){

        //     $this->db->where_in(array(TBL_BLOGS.'.category_ids' => $where_ids));

        // }

        // $where = "FIND_IN_SET(".TBL_BLOGS.'.category_ids'.", $where_id)";

        // $this->db->where($where);

        // $this->db->where(array(TBL_BLOGS.'.id' => $where_id));

        // $method = 'row_array';

        if ($where_id) {

            $this->db->where_in(TBL_BLOGS . '.category_ids', $where_id);

            // $this->db->where(array(TBL_BLOGS.'.id' => $where_id));

            // $method = 'row_array';

        } else if ($where_slug) {

            $this->db->where(array(TBL_BLOGS . '.slug' => $where_slug));

            $method = 'row_array';

        }

        if ($search) {

            $this->db->like(TBL_BLOGS . '.title', $search);

        }

        $this->db->where(array(TBL_BLOG_CATEGORIES . '.status' => 1, TBL_BLOGS . '.status' => 1));

        $this->db->where(TBL_BLOGS . '.is_draft', 0);

        $this->db->order_by(TBL_BLOGS . '.id', 'DESC');

        if ($limit)

            $this->db->limit(5, 0);



        if ($pagination)

            $this->db->limit($pagination['per_page'], $pagination['page']);



        $this->db->group_by(TBL_BLOGS . '.id');



        $query = $this->db->get();

        // echo $this->db->last_query();die;

        return $query->$method();

    }

    function get_blogs_categories_wise($where_id = '', $where_slug = '', $limit = '', $search = '', $pagination = '')

    {

        $method = 'result_array';

        $this->db->select(TBL_BLOGS . '.*, ' . TBL_BLOGS . '.id as blog_id, GROUP_CONCAT(' . TBL_BLOG_CATEGORIES . '.slug ORDER BY ' . TBL_BLOG_CATEGORIES . '.id SEPARATOR ",") as "cat_slug" , GROUP_CONCAT(' . TBL_BLOG_CATEGORIES . '.name ORDER BY ' . TBL_BLOG_CATEGORIES . '.id SEPARATOR ",") as "categories"');

        $this->db->from(TBL_BLOGS);

        if ($where_id) {

            $this->db->join(TBL_BLOG_CATEGORIES, TBL_BLOG_CATEGORIES . '.id = SUBSTRING_INDEX(SUBSTRING_INDEX(' . TBL_BLOGS . '.category_ids, ",", FIND_IN_SET(' . TBL_BLOG_CATEGORIES . '.id, ' . TBL_BLOGS . '.category_ids)), ",", -1)');

        }

        $where = "FIND_IN_SET(" . $where_id . ", " . TBL_BLOGS . '.category_ids' . " )";

        $this->db->where($where);

        if ($where_slug) {

            $this->db->where(array(TBL_BLOGS . '.slug' => $where_slug));

            $method = 'row_array';

        }

        if ($search) {

            $this->db->like(TBL_BLOGS . '.title', $search);

        }

        $this->db->where(array(TBL_BLOG_CATEGORIES . '.status' => 1, TBL_BLOGS . '.status' => 1));

        $this->db->where(TBL_BLOGS . '.is_draft', 0);

        $this->db->order_by(TBL_BLOGS . '.id', 'DESC');

        if ($limit)

            $this->db->limit(5, 0);



        if ($pagination)

            $this->db->limit($pagination['per_page'], $pagination['page']);



        $this->db->group_by(TBL_BLOGS . '.id');



        $query = $this->db->get();

        // echo $this->db->last_query();die;

        return $query->$method();

    }

    public function get_blog_category($where = '')

    {

        $this->db->select();

        $this->db->from(TBL_BLOG_CATEGORIES);

        if (!empty($where))

            $this->db->where($where);

        else

            $this->db->where(array('status' => 1));



        $query = $this->db->get();

        return $query->result_array();

    }



    public function get_active_categories_of_active_blogs()

    {

        $this->db->select(TBL_BLOG_CATEGORIES . '.id,' . TBL_BLOG_CATEGORIES . '.slug,' . TBL_BLOG_CATEGORIES . '.name');

        $this->db->join(TBL_BLOG_CATEGORIES, TBL_BLOG_CATEGORIES . '.id = SUBSTRING_INDEX(SUBSTRING_INDEX(' . TBL_BLOGS . '.category_ids, ",", FIND_IN_SET(' . TBL_BLOG_CATEGORIES . '.id, ' . TBL_BLOGS . '.category_ids)), ",", -1)');

        $this->db->from(TBL_BLOGS);

        $this->db->where(array(TBL_BLOG_CATEGORIES . '.status' => 1, TBL_BLOGS . '.status' => 1));

        $this->db->where(TBL_BLOGS . '.is_draft', 0);

        $this->db->order_by(TBL_BLOG_CATEGORIES . '.id', 'DESC');



        $this->db->group_by(TBL_BLOG_CATEGORIES . '.id');



        $query = $this->db->get();

        return $query->result_array();

    }



    public function get_related_blogs_with_categories($where_data)

    {

        $this->db->select(TBL_BLOGS . '.*, ' . TBL_BLOGS . '.id as blog_id, GROUP_CONCAT(' . TBL_BLOG_CATEGORIES . '.slug ORDER BY ' . TBL_BLOG_CATEGORIES . '.id SEPARATOR ",") as "cat_slug" , GROUP_CONCAT(' . TBL_BLOG_CATEGORIES . '.name ORDER BY ' . TBL_BLOG_CATEGORIES . '.id SEPARATOR ",") as "categories"');



        // $this->db->join(TBL_BLOG_CATEGORIES, TBL_BLOG_CATEGORIES.'.id = SUBSTRING_INDEX(SUBSTRING_INDEX('.TBL_BLOGS.'.category_ids, ",", FIND_IN_SET('.$where_data['cat_id'].', '.TBL_BLOGS.'.category_ids)), ",", -1)');



        $this->db->join(TBL_BLOG_CATEGORIES, TBL_BLOG_CATEGORIES . '.id = SUBSTRING_INDEX(SUBSTRING_INDEX(' . TBL_BLOGS . '.category_ids, ",", FIND_IN_SET(' . TBL_BLOG_CATEGORIES . '.id, ' . TBL_BLOGS . '.category_ids)), ",", -1)');



        $where = "FIND_IN_SET(" . $where_data['cat_id'] . ", " . TBL_BLOGS . '.category_ids' . " )";

        $this->db->where($where);



        // $where = "FIND_IN_SET("..", ".TBL_BLOGS.'.category_ids'." )";

        $this->db->from(TBL_BLOGS);

        $this->db->where_not_in(TBL_BLOGS . '.id', $where_data['id']);

        $this->db->where(TBL_BLOGS . '.is_draft', 0);

        $this->db->limit(3, 0);



        $this->db->order_by(TBL_BLOGS . '.id', 'DESC');

        $this->db->group_by(TBL_BLOGS . '.id');



        $query = $this->db->get();

        return $query->result_array();

    }

    function get_meta_description($table = '', $slug = '')

    {

        if (empty($table) && empty($slug)) {

            return false;

        }

        $result_array = array();

        $this->db->select();

        $this->db->from($table);

        $this->db->where(array('slug' => $slug));

        $query = $this->db->get();

        $result_array = $query->result_array();

        return $result_array;

    }

    function delete_by($id)

    {

        return ($id) ? $this->db->delete(TBL_NEWSLETTER_EMAILS, array('id' => $id)) : false;

    }

    function get_tours_by_name($tour_name = '', $limit = false)

    {

        if (!$tour_name) {

            return false;

        }

        if ($limit) {

            return $this->db->select(TBL_TOUR . '.title, ' . TBL_TOUR . '.slug')->from(TBL_TOUR)->where("title LIKE '%$tour_name%'")->limit(5)->get()->result_array();

        } else {

            return $this->db->select(TBL_TOUR . '.title, ' . TBL_TOUR . '.slug')->from(TBL_TOUR)->where("title LIKE '%$tour_name%'")->get()->result_array();

        }

    }

}

