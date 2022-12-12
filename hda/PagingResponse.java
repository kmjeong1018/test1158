package com.newriver.hondakorea_bo.paging;

import lombok.AllArgsConstructor;
import lombok.Getter;

import java.util.ArrayList;
import java.util.List;

@AllArgsConstructor
@Getter
public class PagingResponse<T> {
    private List<T> list = new ArrayList<>();
    private Pagination pagination;
}
