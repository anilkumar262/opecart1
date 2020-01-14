<?php
class ModelExtensionMstoreappBlocks extends Model {

	public function getBlocks($id) {
		
 		 	$sql = "SELECT 
			id,
            name,
            parent_id,
            block_type,
            image_url,
            image_width,
            image_height,
            link_id,
            link_type,
            sort_order,
            status,
            concat(margin_top,'px',' ',margin_right,'px',' ',margin_bottom,'px',' ',margin_left,'px') as margin,
            concat(padding_top,'px',' ',padding_right,'px',' ',padding_bottom,'px',' ',padding_left,'px') as padding,
            bg_color,
            concat(margin_between,'px') as margin_between,
            concat(border_radius,'%') as border_radius,
            concat(width,'%') as width,
            layout,
            layout_grid_col,
            shape,
            header_align,
            text_color,
            card_style,
            end_time 

            FROM " . DB_PREFIX . "mstoreapp_blocks  where status='1' and parent_id = '" . (int)$id . "' ORDER BY sort_order";

            $query = $this->db->query($sql);

            return $query->rows;
			
	}

	public function getsubChildren($id) {
 		 
 		 	$sql = "SELECT 
			id,
            name,
            parent_id,
            block_type,
            image_url,
            image_width,
            image_height,
            link_id,
            link_type,
            sort_order,
            status,
            concat(margin_top,'px',' ',margin_right,'px',' ',margin_bottom,'px',' ',margin_left,'px') as margin,
            concat(padding_top,'px',' ',padding_right,'px',' ',padding_bottom,'px',' ',padding_left,'px') as padding,
            bg_color,
            concat(margin_between,'px') as margin_between,
            concat(border_radius,'px') as border_radius,
            concat(width,'%') as width,
            layout,
            layout_grid_col,
            shape,
            header_align,
            text_color,
            card_style,
            end_time 

            FROM " . DB_PREFIX . "mstoreapp_blocks  where status='1' and parent_id = '" . (int)$id . "' ORDER BY sort_order";

            $query = $this->db->query($sql);

            return $query->rows;

	}

	public function getAllBlocks() {
		
 		$sql = "SELECT * FROM " . DB_PREFIX . "mstoreapp_blocks";

            $query = $this->db->query($sql);

            return $query->rows;
			
	}


	
}
