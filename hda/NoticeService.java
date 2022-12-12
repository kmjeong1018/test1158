package com.newriver.hondakorea_bo.service;

import com.newriver.hondakorea_bo.model.Notice;
import com.newriver.hondakorea_bo.model.SearchDTO;
import com.newriver.hondakorea_bo.paging.Pagination;
import com.newriver.hondakorea_bo.paging.PagingResponse;
import com.newriver.hondakorea_bo.repository.NoticeMapper;
import lombok.extern.log4j.Log4j2;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.Collections;
import java.util.List;

@Service
@Log4j2
public class NoticeService {

    private final NoticeMapper noticeMapper;

    @Autowired
    public NoticeService(NoticeMapper noticeMapper) {
        this.noticeMapper = noticeMapper;
    }

    public PagingResponse<Notice> getAllNotice(final SearchDTO params) {

        int count = noticeMapper.selectAllNoticeCount(params);
        if (count < 1) {
            return new PagingResponse<>(Collections.emptyList(), null);
        }

        Pagination pagination = new Pagination(count, params);
        params.setPagination(pagination);

        List<Notice> list = noticeMapper.selectAllNotice(params);
        log.info("list: "+ list);
        return new PagingResponse<>(list, pagination);
    }
}
