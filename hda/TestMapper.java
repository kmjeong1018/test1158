package com.newriver.hondakorea_bo.repository;

import com.newriver.hondakorea_bo.model.SearchDTO;
import com.newriver.hondakorea_bo.model.TestDTO;

import org.apache.ibatis.annotations.Mapper;

import java.util.List;

@Mapper
public interface TestMapper {
   List<TestDTO> selectAllTest(SearchDTO searchDTO);

    int selectAllTestCount(SearchDTO searchDTO);
}
