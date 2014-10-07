ALTER TABLE file_sync  
ADD deleted_id INTEGER DEFAULT 0 AFTER file_size,
DROP INDEX object_id_object_type_version_subtype_index, 
ADD UNIQUE KEY unique_index (object_id,object_type,version,object_sub_type,dc,deleted_id);
