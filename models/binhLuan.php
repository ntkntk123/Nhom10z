<?php
class CommentModel {
    public static function saveComment($userId, $commentText, $postId) {
        $conn = connectDB();
        $sql = "INSERT INTO binh_luans (id_khach_hang, noi_dung, id_san_pham, create_at) VALUES (:id_khach_hang, :noi_dung, :id_san_pham, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'user_id' => (int)$userId,
            'comment_text' => $commentText,
            'post_id' => (int)$postId
        ]);
    }
}