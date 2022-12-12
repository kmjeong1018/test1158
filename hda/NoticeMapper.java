package com.newriver.hondakorea_bo.repository;

import com.newriver.hondakorea_bo.model.Notice;
import com.newriver.hondakorea_bo.model.SearchDTO;
import org.apache.ibatis.annotations.Mapper;
import org.springframework.stereotype.Repository;

import java.util.List;

@Mapper
public interface NoticeMapper {
    List<Notice> selectAllNotice(SearchDTO searchDTO);

    int selectAllNoticeCount(SearchDTO searchDTO);
}
