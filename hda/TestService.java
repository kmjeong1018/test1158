package com.newriver.hondakorea_bo.service;

import com.newriver.hondakorea_bo.model.TestDTO;
import com.newriver.hondakorea_bo.model.SearchDTO;
import com.newriver.hondakorea_bo.model.TestDTO;
import com.newriver.hondakorea_bo.paging.Pagination;
import com.newriver.hondakorea_bo.paging.PagingResponse;
import com.newriver.hondakorea_bo.repository.TestMapper;
import lombok.extern.log4j.Log4j2;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.Collections;
import java.util.List;

@Service
@Log4j2
public class TestService {

    private final TestMapper testMapper;

    @Autowired
    public TestService(TestMapper testMapper) {
        this.testMapper = testMapper;
    }

    public PagingResponse<TestDTO> getAllTest(final SearchDTO params) {

        int count = testMapper.selectAllTestCount(params);
        log.info("count = selectAllTestCount(params) ===>" + count);

        if (count < 1) {
            return new PagingResponse<>(Collections.emptyList(), null);
        }

        Pagination pagination = new Pagination(count, params);
        params.setPagination(pagination);

        List<TestDTO> list = testMapper.selectAllTest(params);
        log.info("list: "+ list);
        return new PagingResponse<>(list, pagination);
    }
}
